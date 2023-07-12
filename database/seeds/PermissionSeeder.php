<?php

use App\Enums\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'dashboard',
            'description' => 'داشبورد',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'admins.index',
            'description' => 'ادمین ها',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'admins.create',
            'description' => 'ایجاد ادیمن جدید',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'admins.edit',
            'description' => 'ویرایش ادمین',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'admins.destroy',
            'description' => 'حذف ادمین',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'admins.address.show',
            'description' => 'نمایش آدرس ادمین',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'admins.address.update',
            'description' => 'ویرایش آدرس ادمین',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'admins.feilds.index',
            'description' => 'نمایش رشته تحصیلی ادمین',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'admins.feilds.reate',
            'description' => 'ایجاد رشته تحصیلی ادمین',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'admins.feilds.edit',
            'description' => 'ویرایش رشته تحصیلی ادمین',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'admins.feilds.destroy',
            'description' => 'حذف رشته تحصیلی ادمین',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'admins.medias.index',
            'description' => 'نمایش شبکه های اجتماعی ادمین',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'admins.medias.create',
            'description' => 'ایجاد شبکه های اجتماعی ادمین',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'admins.medias.create',
            'description' => 'ایجاد شبکه های اجتماعی ادمین',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'admins.medias.edit',
            'description' => 'ویرایش شبکه های اجتماعی ادمین',
            'status'=> Status::Deactive
        ]);


        DB::table('permissions')->insert([
            'name' => 'admins.medias.destroy',
            'description' => 'حذف شبکه های اجتماعی ادمین',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'users.index',
            'description' => 'لیست کاربران',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'users.create',
            'description' => 'ایجاد کاربر جدید',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'users.edit',
            'description' => 'ویرایش کاربر',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'users.destroy',
            'description' => 'حذف کاربر',
            'status'=> Status::Active
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'doctors.index',
            'description' => 'لیست پزشکان',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'doctors.info',
            'description' => 'اطلاعات پزشک',
            'status'=> Status::Active
        ]);


        DB::table('permissions')->insert([
            'name' => 'doctors.update',
            'description' => 'ویرایش پزشک',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'doctors.video',
            'description' => 'ویدئو پزشک',
            'status'=> Status::Deactive
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'doctors.video.upload',
            'description' => 'آپلود  ویدئو پزشک',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'doctors.video.store',
            'description' => 'تغییر لینک ویدئو پزشک',
            'status'=> Status::Deactive
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'doctors.delete',
            'description' => 'حذف ویدئو',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'roles.index',
            'description' => 'لیست نقش ها',
            'status'=> Status::Active
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'roles.create',
            'description' => 'افزودن نقش ها',
            'status'=> Status::Active
        ]);

                
        DB::table('permissions')->insert([
            'name' => 'roles.edit',
            'description' => 'ویرایش نقش ها',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'roles.destroy',
            'description' => 'حذف نقش ها',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'levels.index',
            'description' => 'لیست سطوح',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'levels.create',
            'description' => 'ایجاد سطح',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'levels.edit',
            'description' => 'ویرایش سطح',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'levels.destroy',
            'description' => 'حذف سطح',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'gallery.index',
            'description' => 'لیست گالری ها',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'gallery.store',
            'description' => 'ایجاد گالری جدید',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'gallery.update',
            'description' => 'ویرایش گالری',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'gallery.destroy',
            'description' => 'حذف گالری',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'gallery.images.index',
            'description' => 'تصاویر گالری',
            'status'=> Status::Active
        ]);


        DB::table('permissions')->insert([
            'name' => 'gallery.images.store',
            'description' => 'درج تصویر گالری',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'gallery.images.update',
            'description' => 'بروزرسانی تصویر گالری',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'gallery.images.destroy',
            'description' => 'حذف تصویر گالری',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'portfolios.index',
            'description' => 'لیست نمونه کارها',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'portfolios.create',
            'description' => 'ایجاد نمونه کار جدید',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'portfolios.edit',
            'description' => 'ویرایش نمونه کار',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'portfolios.upload',
            'description' => 'آپلود ویدئو نمونه کار',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'portfolios.remove_image',
            'description' => 'حذف تصویر نمونه کار',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'portfolios.delete',
            'description' => 'حذف نمونه کار',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'article.index',
            'description' => 'لیست مقالات',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'article.create',
            'description' => 'ایجاد مقاله جدید',
            'status'=> Status::Active
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'article.edit',
            'description' => 'ویرایش مقاله',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'article.destroy',
            'description' => 'حذف مقاله مقاله',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'article.ckeditor',
            'description' => 'آپلود ویرایشگر متن',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'article.categorys.index',
            'description' => 'دسته بندی مقالات',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'article.categorys.create',
            'description' => 'ایجاد دسته بندی مقالات',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'article.categorys.edit',
            'description' => 'ویرایش دسته بندی مقالات',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'article.categorys.delete',
            'description' => 'حذف دسته بندی مقالات',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'comments.index',
            'description' => 'لیست نظرات مقاله',
            'status'=> Status::Active
        ]);
        
        DB::table('permissions')->insert([
            'name' => 'comments.update',
            'description' => 'پاسخگویی به نظرات مقاله ',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'comments.destroy',
            'description' => 'حذف نظرات مقاله',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'services.index',
            'description' => 'لیست سرویس',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'services.create',
            'description' => 'یجاد سرویس',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'services.edit',
            'description' => 'ویرایش سرویس',
            'status'=> Status::Active
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'services.delete',
            'description' => 'حذف سرویس',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'services.fetch_details',
            'description' => 'فیلتر جزئیات سرویس',
            'status'=> Status::Deactive
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'services.details.index',
            'description' => 'لیست جزئیات سرویس',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'services.details.create',
            'description' => 'ایجاد جزئیات سرویس',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'services.details.edit',
            'description' => 'ویرایش جزئیات سرویس',
            'status'=> Status::Active
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'services.details.delete',
            'description' => 'حذف جزئیات سرویس',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'services.details.images.show',
            'description' => 'نمایش تصاویر جزئیات سرویس',
            'status'=> Status::Deactive
        ]);


        DB::table('permissions')->insert([
            'name' => 'services.details.images.store',
            'description' => 'ایجاد تصویر جزئیات سرویس',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'services.details.images.delete',
            'description' => 'حذف تصویر جزئیات سرویس',
            'status'=> Status::Deactive
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'services.details.videos.show',
            'description' => 'نمایش ویدئوهای جزئیات سرویس',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'services.details.videos.create',
            'description' => 'ایجاد تصویر جزئیات سرویس',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'services.details.videos.upload',
            'description' => 'آپلود ویدئو جزئیات سرویس',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'services.details.videos.delete',
            'description' => 'حذف ویدئو جزئیات سرویس',
            'status'=> Status::Deactive
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'services.details.luck.create',
            'description' => 'افزودن سرویس به قرعه کشی',
            'status'=> Status::Active
        ]);
                
        DB::table('permissions')->insert([
            'name' => 'services.categories.index',
            'description' => 'لیست دسته بندی سرویس',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'services.categories.create',
            'description' => 'ایجاد دسته بندی سرویس',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'services.categories.edit',
            'description' => 'ویرایش دسته بندی سرویس',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'services.categories.delete',
            'description' => 'حذف دسته بندی سرویس',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'services.categories.fetch_child',
            'description' => 'فیلر زیر دسته های سرویس',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'services.categories.sub.index',
            'description' => 'لیست زیردسته های سرویس',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'services.categories.sub.create',
            'description' => 'ایجاد زیردسته های سرویس',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'services.categories.sub.edit',
            'description' => 'ویرایش زیردسته های سرویس',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'services.categories.sub.delete',
            'description' => 'حذف زیردسته های سرویس',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'reviewgroup.index',
            'description' => 'لیست گروه بازخوردها',
            'status'=> Status::Active
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'reviewgroup.create',
            'description' => 'ایجاد گروه بازخوردها',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'reviewgroup.edit',
            'description' => 'ویرایش گروه بازخوردها',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'reviewgroup.destroy',
            'description' => 'حذف گروه بازخوردها',
            'status'=> Status::Active
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'reviews.index',
            'description' => 'لیست بازخوردها',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'reviews.update',
            'description' => 'پاسخگویی به بازخوردها',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'reviews.destroy',
            'description' => 'حذف بازخوردها',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'luck.index',
            'description' => 'لیست قرعه کشی',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'luck.store',
            'description' => 'ایجاد قرعه کشی',
            'status'=> Status::Active
        ]);
        
        DB::table('permissions')->insert([
            'name' => 'luck.update',
            'description' => 'بروزرسانی قرعه کشی',
            'status'=> Status::Active
        ]);


        DB::table('permissions')->insert([
            'name' => 'luck.destroy',
            'description' => 'حذف قرعه کشی',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'discounts.index',
            'description' => 'لیست کد تخفیف',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'discounts.create',
            'description' => 'ایجاد کد تخفیف',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'discounts.edit',
            'description' => 'ویرایش کد تخفیف',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'discounts.destroy',
            'description' => 'حذف کد تخفیف',
            'status'=> Status::Active
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'discounts.show',
            'description' => 'نمایش کد تخفیف',
            'status'=> Status::Active
        ]);


        DB::table('permissions')->insert([
            'name' => 'discounts.services.show',
            'description' => 'نمایش سرویس های کد تخفیف',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'discounts.services.update',
            'description' => 'بروزرسانی سرویس های کد تخفیف',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'discounts.user.show',
            'description' => 'نمایش کاربران های کد تخفیف',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'discounts.user.update',
            'description' => 'بروزرسانی کاربران کد تخفیف',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'shop.products.index',
            'description' => 'لیست محصولات',
            'status'=> Status::Active
        ]);


        DB::table('permissions')->insert([
            'name' => 'shop.products.create',
            'description' => 'درج محصول',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'shop.products.edit',
            'description' => 'ویرایش محصول',
            'status'=> Status::Active
        ]);


        DB::table('permissions')->insert([
            'name' => 'shop.products.delete',
            'description' => 'حذف محصول',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'shop.products.categories.index',
            'description' => 'لیست دسته بندی های محصول',
            'status'=> Status::Active
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'shop.products.categories.create',
            'description' => 'ایجاد دسته‌بندی محصول',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'shop.products.categories.edit',
            'description' => 'ویرایش دسته‌بندی محصول',
            'status'=> Status::Active
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'shop.products.categories.delete',
            'description' => 'حذف دسته‌بندی محصول',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'shop.products.categories.sub.index',
            'description' => 'لیست زیردسته محصول',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'shop.products.categories.sub.create',
            'description' => 'ایجاد زیردسته محصول',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'shop.products.categories.sub.edit',
            'description' => 'ویرایش زیردسته محصول',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'shop.products.categories.sub.delete',
            'description' => 'حذف زیردسته محصول',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'shop.products.images.show',
            'description' => 'نمایش تصاویر محصول',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'shop.products.images.store',
            'description' => 'درج تصویر محصول',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'shop.products.images.delete',
            'description' => 'حذف تصویر محصول',
            'status'=> Status::Active
        ]);


        DB::table('permissions')->insert([
            'name' => 'shop.products.attributes.show',
            'description' => 'لیست ویژگی‌های محصول',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'shop.products.attributes.update',
            'description' => 'بروزرسانی ویژگی‌های محصول',
            'status'=> Status::Active
        ]);


        DB::table('permissions')->insert([
            'name' => 'shop.products.luck.create',
            'description' => 'افزودن محصول به قرعه کشی',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'shop.products.sells.index',
            'description' => 'لیست فروش محصول',
            'status'=> Status::Active
        ]);
        

        DB::table('permissions')->insert([
            'name' => 'shop.products.sells.update',
            'description' => 'تغییر وضعیت فروش',
            'status'=> Status::Active
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'notifications.index',
            'description' => 'لیست اعلانات',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'notifications.create',
            'description' => 'ایجاد اعلان',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'notifications.update',
            'description' => 'ویرایش اعلان',
            'status'=> Status::Active
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'notifications.destroy',
            'description' => 'حذف اعلان',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'rewiewGroups.index',
            'description' => 'لیست گروهای بازخورد',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'rewiewGroups.create',
            'description' => 'ایجاد گروهای بازخورد',
            'status'=> Status::Active
        ]);


        DB::table('permissions')->insert([
            'name' => 'rewiewGroups.update',
            'description' => 'ویرایش گروهای بازخورد',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'rewiewGroups.destroy',
            'description' => 'حذف گروهای بازخورد',
            'status'=> Status::Active
        ]);
        

        DB::table('permissions')->insert([
            'name' => 'reserves.index',
            'description' => 'لیست سرویسهای رزرو شده',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'reserves.create',
            'description' => 'ایجاد رزرو جدید',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'reserves.edit',
            'description' => 'ویرایش رزرو',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'reserves.destroy',
            'description' => 'حذف رزرو',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'reserves.done',
            'description' => 'تایید ارائه خدمت',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'reserves.review',
            'description' => 'مشاهده نظرسنجی خدمت',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'reserves.secratry',
            'description' => 'تعیین منشی',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'reserves.upgrade.index',
            'description' => 'لیست ارتقاء خدمت',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'reserves.upgrade.create',
            'description' => 'افزودن ارتقاء خدمت',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'reserves.upgrade.edit',
            'description' => 'ویرایش ارتقاء خدمت',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'reserves.upgrade.delete',
            'description' => 'حذف ارتقاء خدمت',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'reserves.upgrade.confirm',
            'description' => 'تایید ارتقاء خدمت',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'reserves.payment',
            'description' => 'فاکتور پرداخت رزرو',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'reserves.pay',
            'description' => 'پرداخت رزرو',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'jobs.index',
            'description' => 'لیست مشاغل',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'jobs.create',
            'description' => 'افزودن شغل جدید',
            'status'=> Status::Active
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'jobs.edit',
            'description' => 'ویرایش شغل',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'jobs.destroy',
            'description' => 'حذف شغل',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'departments.index',
            'description' => 'لیست واحدهای پشتیبانی',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'departments.create',
            'description' => 'درج واحد پشتیبانی',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'departments.edit',
            'description' => 'ویرایش واحد پشتیبانی',
            'status'=> Status::Active
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'departments.delete',
            'description' => 'حذف واحد پشتیبانی',
            'status'=> Status::Active
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'tickets.index',
            'description' => 'لیست تیکتها',
            'status'=> Status::Active
        ]);
 
        DB::table('permissions')->insert([
            'name' => 'tickets.changestatus',
            'description' => 'تغییر وضعیت',
            'status'=> Status::Active
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'tickets.show',
            'description' => 'نمایش تیکت',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'tickets.reply',
            'description' => 'پاسخگویی به تیکت',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'tickets.delete',
            'description' => 'حذف تیکت',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'tickets.getaudience',
            'description' => 'فیلتر لیست مخاطبین',
            'status'=> Status::Deactive
        ]);

        DB::table('permissions')->insert([
            'name' => 'provinces.index',
            'description' => 'لیست استانها',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'provinces.edit',
            'description' => 'ویرایش استان',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'provinces.cities.index',
            'description' => 'لیست شهرهای استان',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'provinces.cities.create',
            'description' => 'ایجاد شهر',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'provinces.cities.edit',
            'description' => 'ویرایش شهر',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'provinces.cities.parts.index',
            'description' => 'لیست بخشهای شهر',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'provinces.cities.parts.create',
            'description' => 'ایجاد بخش جدید',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'provinces.cities.parts.edit',
            'description' => 'ویرایش بخش',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'socialmedia.index',
            'description' => 'لیست شبکه های اجتماعی',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'socialmedia.create',
            'description' => 'افزودن شبکه اجتماعی',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'socialmedia.edit',
            'description' => 'ویرایش شبکه اجتماعی',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'socialmedia.delete',
            'description' => 'حذف شبکه اجتماعی',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'phones.index',
            'description' => 'لیست تلفن تماس',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'phones.create',
            'description' => 'افزودن تلفن تماس',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'phones.edit',
            'description' => 'ویرایش تلفن تماس',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'phones.delete',
            'description' => 'حذف تلفن تماس',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'messages.index',
            'description' => 'لیست پیامها',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'messages.show',
            'description' => 'نمایش پیام',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'messages.delete',
            'description' => 'حذف پیام',
            'status'=> Status::Active
        ]);

        
        DB::table('permissions')->insert([
            'name' => 'faq.index',
            'description' => 'لیست سئوالات متداول',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'faq.create',
            'description' => 'افزودن پرسش و پاسخ',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'faq.edit',
            'description' => 'ویرایش پرسش و پاسخ',
            'status'=> Status::Active
        ]);

        DB::table('permissions')->insert([
            'name' => 'faq.destroy',
            'description' => 'حذف پرسش و پاسخ',
            'status'=> Status::Active
        ]);


        DB::table('permissions')->insert([
            'name' => 'numbers.index',
            'description' => 'لیست نمابر',
            'status'=> Status::Active
        ]);





 
    
    }
}
