 @extends('layouts.master')
 @section('content')

     <div id="lottery">
         @include('layouts.header')

         <div class="col-12 px-0 bg-white position-relative" style="top:-100px">
             <div class="confetti col-12 d-flex justify-content-center align-items-center">
                 <div class="w-100 text-center text-white">
                     <h2 class="dima text-white">گردونه شانس لاوین</h2>
                     <p class="mt-4">از بین شرایط های ویژه خدمات و محصولات لاوین فکر میکنی کدوم رو میبری؟ امتحان کن.</p>
                 </div>
             </div>
         </div>

         <div class="d-flex justify-content-center align-items-center" style="height: 100vh;margin-top: -100px" dir="ltr">
             <div id="wheelOfFortune">
                 <canvas id="wheel" width="480" height="480" ></canvas>
                 <div id="spin">شروع</div>
             </div>
         </div>
     </div>

 @stop

 @push('js')

<script>

    const colors = ["#dadada","#000","#dadada","#000","#dadada","#000","#dadada","#000","#dadada","#000","#dadada","#000"]

    let data = [
        @foreach($lucks as $luck)
        { label:"{{ $luck->lucktable->name }}",
            id:"{{ $luck->id }}",
            discount: "{{ $luck->discount }}",
            type:"{{ $luck->lucktable_type == "App\\Models\\Product" ? 'محصول' : 'خدمت'}}"
        },
        @endforeach
    ];

    selected_sector = data.find(d => d.id == "{{ $win }}");
    console.log(selected_sector);

    data = data.filter(function( obj ) {
        return obj.id !== "{{ $win }}";
    });

    data.unshift(selected_sector);

    const sectors = data;

    console.log(sectors);

    const rand = (m, M) => Math.random() * (M - m) + m;
    const tot = sectors.length;
    const EL_spin = document.querySelector("#spin");
    const ctx = document.querySelector("#wheel").getContext('2d');
    const dia = ctx.canvas.width;
    const rad = dia / 2;
    const PI = Math.PI;
    const TAU = 2 * PI;
    const arc = TAU / sectors.length;

    const friction = 0.99; // 0.995=soft, 0.99=mid, 0.98=hard
    let angVel = 0; // Angular velocity
    let ang = 0; // Angle in radians

    const getIndex = () => Math.floor(tot - ang / TAU * tot) % tot;

    function drawSector(sector, i) {
        const ang = arc * i;
        ctx.save();
        // COLOR
        ctx.beginPath();
        ctx.fillStyle = colors[i];
        ctx.moveTo(rad, rad);
        ctx.arc(rad, rad, rad, ang, ang + arc);
        ctx.lineTo(rad, rad);
        ctx.fill();
        // TEXT
        ctx.translate(rad, rad);
        ctx.rotate(ang + arc / 2);
        ctx.textAlign = "right";
        ctx.fillStyle = "#fff";
        ctx.font = "13px yekan";
        ctx.fillText(sector.type , rad - 10, -8);
        ctx.fillText(sector.label, rad - 10, 10);
        ctx.fillText(sector.discount+'% تخفیف', rad - 10, 28);
        //
        ctx.restore();
    };

    function rotate() {
        const sector = sectors[getIndex()];
        ctx.canvas.style.transform = `rotate(${ang - PI / 2}rad)`;
        EL_spin.textContent = !angVel ? "شروع" : sector.label;
    }

    let message = '';
    let title = ``;
    function frame() {
        if (!angVel) return;
        angVel *= friction; // Decrement velocity by friction
        if (angVel < 0.002){
            angVel = 0; // Bring to stop
            Swal.fire({
                html: `<div class="text-center">
                        <img src="/images/front/giftbox.png" class="rounded w-100">
                        <h4 class="px-3">${ message }</h4>
                        <p class="px-3">${ title }</p>
                        </div>`,
                confirmButtonColor: '#000',
                confirmButtonText: 'باشه'})
        }
        ang += angVel; // Update angle
        ang %= TAU; // Normalize angle
        rotate();
    }

    function engine() {
        frame();
        requestAnimationFrame(engine);
    }

    // INIT
    sectors.forEach(drawSector);
    rotate(); // Initial rotation
    engine(); // Start engine
    EL_spin.addEventListener("click", () => {
        @auth
            axios.post('{{ route("website.lottery.start") }}',{
            win: `{{ $win }}`
        }).then(res => {
                if(res.status == 200){
                    if (!angVel) angVel = 0.6985;
                    message = res.data.message;
                    title = `کد تخفیف شما ${res.data.discount} می باشد. لطفا جهت استفاده، از این کد نگهداری کنید.`;
                }
            }).catch(err => {
                Swal.fire({
                    title: err.response.data.message,
                    confirmButtonText: 'باشه',
                    confirmButtonColor:'red'});
            })

        @else
            $('#loginModal').modal();
        @endauth
    });

</script>

 @endpush

 @push('css')
     <style>
         #lottery{
             background-image: url("/images/front/lottery-bg.jpg");
             background-position: center;
             background-size: cover;
             min-height: 100vh !important;
         }
         .page{
             min-height: 100px !important;
         }
         #lottery .rd-navbar-static:not(.rd-navbar--is-stuck) .rd-navbar-nav > li > a:hover {
             color: white;
         }

         #search-icon:hover > svg path, #search-icon:hover > svg g{
             stroke: white !important;
         }

         #notice-icon:hover > svg #Path_105 .cc, #notice-icon:hover > svg #Ellipse_2{
             fill: white !important;
         }


         #wheelOfFortune {
             display: inline-block;
             position: relative;
             overflow: hidden;
             box-shadow: 0 3px 15px rgba(0, 0, 0, 0.45);
             border-radius: 50%;
         }

         #wheel {
             display: block;
         }
         @media screen and (max-width: 495px){
            #wheel{
                width: 100%;
                height: unset;
            }
         }

         #spin {
             user-select: none;
             cursor: pointer;
             display: flex;
             justify-content: center;
             align-items: center;
             position: absolute;
             top: 50%;
             left: 50%;
             width: 30%;
             height: 30%;
             margin: -15%;
             background: #2ed3ae;
             color: #fff;
             box-shadow: 0 0 0 8px currentColor, 0 0px 15px 5px rgba(0, 0, 0, 0.6);
             border-radius: 50%;
             transition: 0.8s;
             text-align: center;
         }

         #spin::after {
             content: "";
             position: absolute;
             top: -17px;
             border: 10px solid transparent;
             border-bottom-color: currentColor;
             border-top: none;
         }

         .rd-navbar-static:not(.rd-navbar--is-stuck) .rd-navbar-nav > li > a{
             /*color: #eeeeee;*/
         }
         .swal2-html-container{
             margin: 0 !important;
         }
         .confetti{
             height: 300px;
             background-image: url('/images/front/confetti.gif');
             background-color: #2ed3ae;
             background-blend-mode: exclusion;
             background-repeat: repeat-x;
             background-size: 20%;
         }
     </style>
 @endpush
