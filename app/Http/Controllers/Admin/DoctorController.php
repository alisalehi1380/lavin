<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Doctor;
use \Morilog\Jalali\Jalalian;
use App\Services\FunctionService;
use App\Services\VideoService;
use Auth;

class DoctorController extends Controller
{
    private $fuctionService;

    public function __construct()
    {
        $this->fuctionService = new FunctionService();
        $this->videoService = new VideoService();
    }

    public function index()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('doctors.index');

        $doctors = Admin::whereHas('roles', function($q){$q->where('name', 'doctor');})->orderBy('fullname','asc')->paginate(10);
       
        return view('admin.doctors.all',compact('doctors'));
    }

    public function info(Admin $doctor)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('doctors.info');

        $doctor = Admin::with('doctor')->find($doctor->id);
        Doctor::where('admin_id',$doctor->id)->firstOrCreate([
            'admin_id'=>$doctor->id
        ]);

        return view('admin.doctors.info',compact('doctor'));
    }

    public function update(Admin $doctor,Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('doctors.update');

        $request->validate([
            'code'=>'nullable|max:20',
            'speciality'=>'nullable|max:255',
            'desc'=>'nullable|max:63000',
        ],
        [
            'code.max'=>'* حدکثر 20 کارکتر',
            'speciality.max'=>'* حدکثر 255 کارکتر',
            'desc.max'=>'* حدکثر 63000 کارکتر',
        ]);
          
        if(isset($request->codeStartDate))
        {
            $codeStartDate =  $this->fuctionService->faToEn($request->codeStartDate);
            $codeStartDate = Jalalian::fromFormat('Y/m/d', $codeStartDate)->toCarbon("Y-m-d");
        }
        else
        {
            $codeStartDate =  null;
        }

        if(isset($request->expireDate))
        {
            $expireDate =  $this->fuctionService->faToEn($request->expireDate);
            $expireDate = Jalalian::fromFormat('Y/m/d', $expireDate)->toCarbon("Y-m-d");
        }
        else
        {
            $expireDate =  null;
        }
 
        $dr = Doctor::where('admin_id',$doctor->id)->firstOrNew([
            'admin_id'=>$doctor->id
        ]);

        $dr->code = $request->code;
        $dr->speciality = $request->speciality;
        $dr->codeStartDate = $codeStartDate;
        $dr->expireDate = $expireDate;
        $dr->desc = $request->desc;
        $dr->save();
        
        toast('بروزرسانی انجام شد.','success')->position('bottom-end'); 

        return redirect(route('admin.doctors.index'));
    }

    public function video(Doctor $doctor)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('doctors.video');

        return view('admin.doctors.video',compact('doctor'));
    }

    public function videoupload(Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('doctors.upload');

        $request->validate(
            [
                'video' =>'required|mimes:mp4,mov,ogg | max:102400',
            ],
            [
                "video.required" => "* الزامی است.",
                "video.max"=>"حداکثر حجم مجاز برای تصویر شما 100 مگابایت است.",
                "video.image"=>"* فرمت‌های مجاز mp4,mov,ogg",
            ]);

            $path = $this->videoService->path();
            $video = $this->videoService->upload($request->video,$path);

            $url =  url('/').'/'.$path.$video;

            return response()->json([
                'url'=>$url
            ],200);
    }

    public function store_video(Doctor $doctor,Request $request)
    {
        
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('doctors.video.store');

        $request->validate([
            'link'=>'nullable|max:63000',
        ],
        [
            'code.max'=>'* حدکثر 63000 کارکتر',
        ]);

        $doctor->video = $request->link;
        $doctor->save();

        return redirect(route('admin.doctors.info',[$doctor->admin_id,$doctor]));
    }

    public function remove_video($link)
    {
        $home = url('/').'/';

        $file = str_replace($home,'',$link);
        if(file_exists($file))
        {
            File::delete($file);
        }
    }
}
