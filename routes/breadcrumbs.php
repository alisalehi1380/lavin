<?php

// ادمین ها

//داشبورد
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('داشبورد', route('admin.dashboard'));
});

// داشبورد > مقالات
Breadcrumbs::for('articles', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('مقالات', route('admin.article.index'));
});

// داشبورد > مقالات > ایجاد مقاله جدید
Breadcrumbs::for('article.create', function ($trail) {
    $trail->parent('articles', $trail);
    $trail->push('ایجاد مقاله جدید', route('admin.article.create'));
});

// داشبورد > مقالات > ویرایش مقاله 
Breadcrumbs::for('article.edit', function ($trail,$article) {
    $trail->parent('articles', $trail);
    $trail->push('ویرایش مقاله ', route('admin.article.edit',$article));
});


//داشبورد > مقالات > دسته بندی مقالات 
Breadcrumbs::for('article.categorys.index', function ($trail) {
    $trail->parent('articles', $trail);
    $trail->push('دسته بندی مقالات', route('admin.article.categorys.index'));
});


//داشبورد > مقالات > دسته بندی مقالات > ایجاد دسته بندی جدید  
Breadcrumbs::for('article.categorys.create', function ($trail) {
    $trail->parent('article.categorys.index', $trail);
    $trail->push('ایجاد دسته بندی جدید', route('admin.article.categorys.create'));
});

//داشبورد > مقالات > دسته بندی مقالات > ویرایش دسته بندی   
Breadcrumbs::for('article.categorys.edit', function ($trail,$category) {
    $trail->parent('article.categorys.index', $trail);
    $trail->push('ویرایش دسته بندی', route('admin.article.categorys.edit', $category));
});


// داشبورد >  سرگروه خدمات 
Breadcrumbs::for('services', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('سرگروه خدمات', route('admin.services.index'));
});

// داشبورد > سرگروه خدمت >افزودن سرگروه خدمات 
Breadcrumbs::for('services.create', function ($trail) {
    $trail->parent('services', $trail);
    $trail->push('افزودن سرگروه  جدید', route('admin.services.create'));
});

// داشبورد > سرگروه خدمت > ویرایش سرگروه خدمت 
Breadcrumbs::for('services.edit', function ($trail,$service) {
    $trail->parent('services', $trail);
    $trail->push('ویرایش سرگروه خدمت', route('admin.services.edit',$service));
});

// داشبورد > سرگروه خدمت >  خدمات 
Breadcrumbs::for('services.detiles', function ($trail) {
    $trail->parent('services', $trail);
    $trail->push('خدمات', route('admin.details.index'));
});
 

// داشبورد > سرگروه خدمت >  خدمات > ایجاد خدمت جدید
Breadcrumbs::for('services.detiles.create', function ($trail) {
    $trail->parent('services.detiles');
    $trail->push('ایجاد خدمت ', route('admin.details.create'));
});

// داشبورد > سرگروه خدمت >  خدمات > ویرایش خدمت 
Breadcrumbs::for('services.detiles.edit', function ($trail,$detail) {
    $trail->parent('services.detiles');
    $trail->push('ویرایش خدمت ', route('admin.details.edit',$detail));
});

// داشبورد > سرگروه خدمت >  خدمات >  ویدئو خدمت 
Breadcrumbs::for('services.detiles.videos', function ($trail,$detail) {
    $trail->parent('services.detiles');
    $trail->push('ویدئوهای خدمت', route('admin.details.videos.show',$detail));
});


//  داشبورد > سرگروه خدمت >  خدمات >  ویدئو خدمت > ایجاد ویدئو جدید
Breadcrumbs::for('services.detiles.videos.create', function ($trail,$detail) {
    $trail->parent('services.detiles.videos',$detail);
    $trail->push('افزوده ویدئو', route('admin.details.videos.create',$detail));
});


 // داشبورد > سرگروه خدمت >  خدمات >  تصاویر خدمت 
Breadcrumbs::for('services.detiles.images', function ($trail,$detail) {
    $trail->parent('services.detiles');
    $trail->push('تصاویر خدمت', route('admin.details.images.show',$detail));
});


// داشبورد > سرگروه خدمت >  خدمات >  ویدئو خدمت 
Breadcrumbs::for('services.detiles.luck', function ($trail,$detail) {
    $trail->parent('services.detiles');
    $trail->push('افزودن به گرونه شانس', route('admin.details.luck.create',$detail));
});



// داشبورد >   دسته بندی خدمات 
Breadcrumbs::for('services.cat', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('دسته بندی خدمات', route('admin.services.categories.index'));
});

// داشبورد >   دسته بندی خدمات  > ایجاد دسته بندی جدید 
Breadcrumbs::for('services.cat.create', function ($trail) {
    $trail->parent('services.cat', $trail);
    $trail->push('ایجاد دسته بندی جدید ', route('admin.services.categories.create'));
});

// داشبورد >   دسته بندی خدمات  > ویرایش دسته بندی 
Breadcrumbs::for('services.cat.edit', function ($trail,$category) {
    $trail->parent('services.cat', $trail);
    $trail->push('ویرایش دسته بندی', route('admin.services.categories.edit',$category));
});

// داشبورد >   دسته بندی خدمات  > زیر دسته ها 
Breadcrumbs::for('services.cat.sub', function ($trail,$parent) {
    $trail->parent('services.cat', $parent);
    $trail->push('زیردسته ها', route('admin.services.categories.sub.index',$parent));
});


// داشبورد >   دسته بندی خدمات  > زیر دسته ها > ایجاد  زیردسته 
Breadcrumbs::for('services.cat.sub.create', function ($trail,$parent) {
    $trail->parent('services.cat.sub', $parent);
    $trail->push('ایجاد زیردسته', route('admin.services.categories.sub.create',$parent));
});


//  داشبورد >   دسته بندی خدمات  > زیر دسته ها > ویرایش  زیردسته 
Breadcrumbs::for('services.cat.sub.edit', function ($trail,$parent,$sub) {
    $trail->parent('services.cat.sub', $parent);
    $trail->push('ویرایش زیردسته', route('admin.services.categories.sub.edit',[$parent,$sub]));
});


// داشبورد > رزرو
Breadcrumbs::for('reserves', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('رزرو', route('admin.reserves.index'));
});

// داشبورد > رزرو > ایجاد
Breadcrumbs::for('reserves.create', function ($trail) {
    $trail->parent('reserves', $trail);
    $trail->push('ایجاد رزرو', route('admin.reserves.create'));
});


// داشبورد > رزرو > ویرایش
Breadcrumbs::for('reserves.edit', function ($trail,$reserve) {
    $trail->parent('reserves', $trail);
    $trail->push('ویرایش رزرو', route('admin.reserves.edit',$reserve));
});


// داشبورد > رزرو > ارتقاء
Breadcrumbs::for('reserves.upgrade', function ($trail,$reserve) {
    $trail->parent('reserves', $trail);
    $trail->push('ارتقاء', route('admin.reserves.upgrade.index',$reserve));
});


// داشبورد > رزرو > ارتقاء > جدید
Breadcrumbs::for('reserves.upgrade.create', function ($trail,$reserve) {
    $trail->parent('reserves.upgrade',$reserve);
    $trail->push('ارتقاء جدید', route('admin.reserves.upgrade.create',$reserve));
});

// داشبورد > رزرو > ارتقاء > ویرایش ارتقاء
Breadcrumbs::for('reserves.upgrade.edit', function ($trail,$reserve,$upgrade) {
    $trail->parent('reserves.upgrade',$reserve);
    $trail->push('ویرایش ارتقاء', route('admin.reserves.upgrade.edit',[$reserve,$upgrade]));
});


 // داشبورد > دکتر
Breadcrumbs::for('doctors', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('پزشکان', route('admin.doctors.index'));
});


 //    داشبورد > دکتر > اطلاعات
 Breadcrumbs::for('doctors.info', function ($trail,$doctor) {
    $trail->parent('doctors', $trail);
    $trail->push('اطلاعات پزشک', route('admin.doctors.info',$doctor));
});

 //  داشبورد > دکتر > اطلاعات > ویدئو پزشک 
 Breadcrumbs::for('doctors.info.video', function ($trail,$doctor) {
    $trail->parent('doctors.info', $doctor);
    $trail->push('ویدئو پزشک', route('admin.doctors.video',$doctor));
});

 // داشبورد > تیکت ها
 Breadcrumbs::for('tickets', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('تیکت ها', route('admin.tickets.index'));
});

 // داشبورد > تیکت ها > نمایش تیکت 
 Breadcrumbs::for('ticket.show', function ($trail,$ticket) {
    $trail->parent('tickets', $trail);
    $trail->push('نمایش تیکت ', route('admin.tickets.show',$ticket));
});


 // داشبورد > تیکت ها >  واحدهای پشتیبانی 
 Breadcrumbs::for('ticket.departments', function ($trail) {
    $trail->parent('tickets', $trail);
    $trail->push('واحدهای پشتیبانی ', route('admin.departments.index'));
});


 //  داشبورد > تیکت ها >  واحدهای پشتیبانی >ایجاد واحد جدید 
 Breadcrumbs::for('ticket.departments.create', function ($trail) {
    $trail->parent('ticket.departments', $trail);
    $trail->push('ایجاد واحد جدید', route('admin.departments.create'));
});

//  داشبورد > تیکت ها >  واحدهای پشتیبانی >ویرایش واحد  
Breadcrumbs::for('ticket.departments.edit', function ($trail,$department) {
    $trail->parent('ticket.departments', $trail);
    $trail->push('ویرایش واحد', route('admin.departments.edit',$department));
});

// داشبورد > اعلانات  
Breadcrumbs::for('notifications', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('اعلانات', route('admin.notifications.index'));
});

//  داشبورد > اعلانات >  اعلان جدید  
Breadcrumbs::for('notifications.create', function ($trail) {
    $trail->parent('notifications', $trail);
    $trail->push('اعلان جدید', route('admin.notifications.create'));
});


// داشبورد > گروه های بازخورد
Breadcrumbs::for('rewiewgroups', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('گروه بازخوردها', route('admin.rewiewGroups.index'));
});

//داشبورد > گروه های بازخورد> جدید
Breadcrumbs::for('rewiewgroups.create', function ($trail) {
    $trail->parent('rewiewgroups', $trail);
    $trail->push('گروه بازخورد جدید', route('admin.rewiewGroups.create'));
});

//داشبورد > گروه های بازخورد> ویرایش
Breadcrumbs::for('rewiewgroups.edit', function ($trail,$reviewgroup) {
    $trail->parent('rewiewgroups', $trail);
    $trail->push('ویرایش گروه بازخورد', route('admin.rewiewGroups.edit',$reviewgroup));
});

// داشبورد > بازخوردها
Breadcrumbs::for('reviews', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('بازخوردها', route('admin.rewiewGroups.index'));
});


// داشبورد > گالری ها
Breadcrumbs::for('galleries', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('گالری ها', route('admin.gallery.index'));
});

// داشبورد > گالری ها
Breadcrumbs::for('gallery.image', function ($trail, $gallery) {
    $trail->parent('galleries', $trail);
    $trail->push('تصاویر گالری', route('admin.gallery.images.index', $gallery));
});


// داشبورد >  محصولات
Breadcrumbs::for('products', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('محصولات', route('admin.shop.products.index'));
});


//  داشبورد >  محصولات > ایجاد محصول
Breadcrumbs::for('products.create', function ($trail) {
    $trail->parent('products', $trail);
    $trail->push('ایجاد محصول', route('admin.shop.products.create'));
});

//  داشبورد >  محصولات > ویرایش محصول
Breadcrumbs::for('products.edit', function ($trail,$product) {
    $trail->parent('products', $trail);
    $trail->push('ویرایش محصول', route('admin.shop.products.edit',$product));
});


//  داشبورد >  محصولات >  ویژگی های محصول
Breadcrumbs::for('products.attributes', function ($trail,$product) {
    $trail->parent('products', $trail);
    $trail->push('ویژگی های محصول', route('admin.shop.products.attributes.show',$product));
});

//  داشبورد >  محصولات > تصاویر محصول
Breadcrumbs::for('products.images', function ($trail,$product) {
    $trail->parent('products', $trail);
    $trail->push('تصاویر محصول', route('admin.shop.products.images.show',$product));
});


//  داشبورد >  محصولات >  افزون به قرعه کشی
Breadcrumbs::for('products.luck', function ($trail,$product) {
    $trail->parent('products', $trail);
    $trail->push('افزودن به قرعه کشی', route('admin.shop.products.luck.create',$product));
});


//  داشبورد >  محصولات >  دسته بندی محصولات
Breadcrumbs::for('products.categories', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('دسته بندی محصولات', route('admin.shop.products.categories.index'));
});

 //    داشبورد >  محصولات >  دسته بندی محصولات > جدید
Breadcrumbs::for('products.categories.create', function ($trail) {
    $trail->parent('products.categories', $trail);
    $trail->push('ایجاد دسته بندی جدید', route('admin.shop.products.categories.create'));
});


 //    داشبورد >  محصولات >  دسته بندی محصولات > ویرایش
 Breadcrumbs::for('products.categories.edit', function ($trail,$category) {
    $trail->parent('products.categories', $trail,$category);
    $trail->push('ویرایش دسته بندی', route('admin.shop.products.categories.edit',$category));
});


 //    داشبورد >  محصولات >  دسته بندی محصولات > زیردسته ها
 Breadcrumbs::for('products.categories.sub', function ($trail,$category) {
    $trail->parent('products.categories', $trail);
    $trail->push('زیردسته ها', route('admin.shop.products.categories.sub.index',$category));
});

 //    داشبورد >  محصولات >  دسته بندی محصولات > زیردسته ها > ایجاد زیردسته جدید
 Breadcrumbs::for('products.categories.sub.create', function ($trail,$category) {
    $trail->parent('products.categories.sub', $category);
    $trail->push('زیردسته جدید', route('admin.shop.products.categories.sub.create',$category));
});



 //    داشبورد >  محصولات >  دسته بندی محصولات > زیردسته ها >  ویرایش زیردسته
 Breadcrumbs::for('products.categories.sub.edit', function ($trail,$category,$sub) {
    $trail->parent('products.categories.sub', $category);
    $trail->push('ویرایش زیردسته', route('admin.shop.products.categories.sub.edit',[$category,$sub]));
});



//  داشبورد  > لیست فروش
Breadcrumbs::for('orders', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('لیست فروش', route('admin.shop.sells.index'));
});


//  داشبورد  >  تخفیف ها
Breadcrumbs::for('discounts', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('تخفیف ها', route('admin.discounts.index'));
});


// داشبورد >  تخفیف ها> ایجاد تخفیف جدید
Breadcrumbs::for('discounts.create', function ($trail) {
    $trail->parent('discounts', $trail);
    $trail->push('تخفیف ها', route('admin.discounts.create'));
});

// داشبورد >  تخفیف ها> ویرایش تخفیف 
Breadcrumbs::for('discounts.edit', function ($trail,$discount) {
    $trail->parent('discounts', $trail);
    $trail->push('ویرایش تخفیف', route('admin.discounts.edit',$discount));
});

// داشبورد >  تخفیف ها>  کاربر 
Breadcrumbs::for('discounts.users', function ($trail,$discount) {
    $trail->parent('discounts', $trail);
    $trail->push('کاربران', route('admin.discounts.users.show',$discount));
});


// داشبورد >  تخفیف ها>  سرویس ها 
Breadcrumbs::for('discounts.services', function ($trail,$services) {
    $trail->parent('discounts', $trail);
    $trail->push('سرویس ها', route('admin.discounts.services.show',$services));
});


// داشبورد >   گردونه شانس
Breadcrumbs::for('luck', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('گردونه شانس', route('admin.luck.index'));
});


// داشبورد >  نمونه کار
Breadcrumbs::for('portfolios', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('نمونه کار', route('admin.portfolios.index'));
});



//  داشبورد >  نمونه کار > ایجاد
Breadcrumbs::for('portfolios.create', function ($trail) {
    $trail->parent('portfolios', $trail);
    $trail->push('ایجاد نمونه کار', route('admin.portfolios.index'));
});



//  داشبورد >  نمونه کار > ویرایش
Breadcrumbs::for('portfolios.edit', function ($trail,$portfolio) {
    $trail->parent('portfolios', $trail);
    $trail->push('ویرایش نمونه کار', route('admin.portfolios.edit',$portfolio));
});


 
// داشبورد > نظرات
Breadcrumbs::for('commnets', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('نظرات', route('admin.comments.index'));
});


<<<<<<< HEAD
//استان > شهرها
=======
// داشبورد > نظرات
>>>>>>> 81da76619afbda98fdcda67bbd545320039d7d49
Breadcrumbs::for('provinces', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('استان ها', route('admin.provinces.index'));
});


//  داشبورد > استان ها> ویرایش استان
Breadcrumbs::for('provinces.edit', function ($trail,$province) {
    $trail->parent('provinces', $trail);
    $trail->push('ویرایش استان', route('admin.provinces.edit',$province));
});
<<<<<<< HEAD

//  داشبورد > استان ها> شهرها
Breadcrumbs::for('provinces.cities.index', function ($trail,$province) {
    $trail->parent('provinces', $trail);
    $trail->push('شهرها', route('admin.provinces.cities.index',$province));
});
 
//  داشبورد > استان ها> شهرها > ایجاد شهر جدید
 Breadcrumbs::for('provinces.cities.create', function ($trail,$province) {
    $trail->parent('provinces.cities.index',$province);
    $trail->push('ایجاد شهر جدید', route('admin.provinces.cities.create',$province));
});
 
 // داشبورد > استان ها> شهرها > ویرایش شهر
Breadcrumbs::for('provinces.cities.edit', function ($trail,$province,$city) {
    $trail->parent('provinces.cities.index', $province);
    $trail->push('ویرایش شهر', route('admin.provinces.cities.edit',[$province,$city]));
});
 

 // داشبورد > استان ها> شهرها >  نواحی
Breadcrumbs::for('provinces.cities.parts.index', function ($trail,$province,$city) {
    $trail->parent('provinces.cities.index', $city);
    $trail->push('نواحی', route('admin.provinces.cities.parts.index',[$province,$city]));
});


 // داشبورد > استان ها> شهرها >   ایجاد ناحیه جدید
Breadcrumbs::for('provinces.cities.parts.create', function ($trail,$province,$city) {
    $trail->parent('provinces.cities.index', $city);
    $trail->push('ایجاد ناحیه جدید', route('admin.provinces.cities.parts.create',[$province,$city]));
});


 // داشبورد > استان ها> شهرها > ویرایش ناحیه
Breadcrumbs::for('provinces.cities.parts.edit', function ($trail,$province,$city,$part) {
    $trail->parent('provinces.cities.index', $city);
    $trail->push('ویرایش ناحیه', route('admin.provinces.cities.parts.edit',[$province,$city,$part]));
});
 
 
 
 
=======
>>>>>>> 81da76619afbda98fdcda67bbd545320039d7d49
 
 // داشبورد > مشاغل
Breadcrumbs::for('jobs', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('مشاغل', route('admin.jobs.index'));
});


 
 // داشبورد > مشاغل > ایجاد شغل جدید
 Breadcrumbs::for('jobs.create', function ($trail) {
    $trail->parent('jobs', $trail);
    $trail->push('ایجاد شغل جدید', route('admin.jobs.create'));
});

 
 // داشبورد > مشاغل > ویرایش شغل
 Breadcrumbs::for('jobs.edit', function ($trail,$job) {
    $trail->parent('jobs', $trail);
    $trail->push('ویرایش شغل', route('admin.jobs.edit',$job));
});


 // داشبورد > رسانه های اجتماعی
 Breadcrumbs::for('socialmedia', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('رسانه های اجتماعی', route('admin.socialmedia.index'));
});


 // داشبورد > رسانه های اجتماعی > ایجاد  رسانه اجتماعی جدید
 Breadcrumbs::for('socialmedia.create', function ($trail) {
    $trail->parent('socialmedia', $trail);
    $trail->push('ایجاد رسانه اجتماعی جدید', route('admin.socialmedia.index'));
});


 // داشبورد > رسانه های اجتماعی > ویرایش  رسانه اجتماعی 
 Breadcrumbs::for('socialmedia.edit', function ($trail,$socialmedia) {
    $trail->parent('socialmedia', $trail);
    $trail->push('ویرایش رسانه اجتماعی ', route('admin.socialmedia.edit',$socialmedia));
});

 
 // داشبورد > تلفن های تماس
 Breadcrumbs::for('phones', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('تلفن های تماس', route('admin.phones.index'));
});


 
 //  داشبورد > تلفن های تماس  > ایجاد تلفن جدید
 Breadcrumbs::for('phones.create', function ($trail) {
    $trail->parent('phones', $trail);
    $trail->push('تلفن جدید', route('admin.phones.create'));
});


 //  داشبورد > تلفن های تماس  > ویرایش تلفن
 Breadcrumbs::for('phones.edit', function ($trail,$phone) {
    $trail->parent('phones', $trail);
    $trail->push('ویرایش تلفن', route('admin.phones.edit',$phone));
});


 // داشبورد >  پیام ها
 Breadcrumbs::for('messages', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('پیام ها', route('admin.messages.index'));
});

 

 //   داشبورد >  پیام ها > نمایش پیام 
 Breadcrumbs::for('messages.show', function ($trail,$message) {
    $trail->parent('messages', $trail);
    $trail->push('نمایش پیام', route('admin.messages.show',$message));
});

 
 // داشبورد >  ادمین ها
 Breadcrumbs::for('admins', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('ادمین ها', route('admin.admins.index'));
});


 //  داشبورد >  ادمین ها > ایجاد ادمین جدید
 Breadcrumbs::for('admins.create', function ($trail) {
    $trail->parent('admins', $trail);
    $trail->push('ادمین جدید', route('admin.admins.create'));
});

 //  داشبورد >  ادمین ها > ویرایش  ادمین
 Breadcrumbs::for('admins.edit', function ($trail,$admin) {
    $trail->parent('admins', $trail);
    $trail->push('ویرایش ادمین', route('admin.admins.edit',$admin));
});

 //  داشبورد >  ادمین ها > آدرس  ادمین
 Breadcrumbs::for('admins.address', function ($trail,$admin) {
    $trail->parent('admins', $trail);
    $trail->push('آدرس ادمین', route('admin.admins.address.show',$admin));
});

 
 //  داشبورد >  ادمین ها > رشته های تحصیلی ادمین
 Breadcrumbs::for('admins.feilds', function ($trail,$admin) {
    $trail->parent('admins', $trail);
    $trail->push('رشته های تحصیلی ادمین', route('admin.admins.feilds.index',$admin));
});


 //   داشبورد >  ادمین ها > رشته های تحصیلی ادمین  > افزودن رشته جدید
 Breadcrumbs::for('admins.feilds.create', function ($trail,$admin) {
    $trail->parent('admins.feilds', $admin);
    $trail->push('افزودن رشته جدید', route('admin.admins.feilds.create',$admin));
});

 //   داشبورد >  ادمین ها > رشته های تحصیلی ادمین  > ویرایش رشته
 Breadcrumbs::for('admins.feilds.edit', function ($trail,$admin,$feild) {
    $trail->parent('admins.feilds', $admin);
    $trail->push('ویرایش رشته', route('admin.admins.feilds.edit',[$admin,$feild]));
});


 //  داشبورد >  ادمین ها > شبکه های اجتماعی ادمین
 Breadcrumbs::for('admins.medias', function ($trail,$admin) {
    $trail->parent('admins', $trail);
    $trail->push('شبکه های اجتماعی ادمین', route('admin.admins.medias.index',$admin));
});

 
 //  داشبورد >  ادمین ها > شبکه های اجتماعی ادمین  > جدید
 Breadcrumbs::for('admins.medias.create', function ($trail,$admin) {
    $trail->parent('admins.medias', $admin);
    $trail->push('ایجاد شبکه اجتماعی جدید', route('admin.admins.medias.create',$admin));
});

 //  داشبورد >  ادمین ها > شبکه های اجتماعی ادمین  > ویرایش شبکه
 Breadcrumbs::for('admins.medias.edit', function ($trail,$admin,$media) {
    $trail->parent('admins.medias', $admin);
    $trail->push('ویرایش شبکه اجتماعی', route('admin.admins.medias.edit',[$admin,$media]));
});

 // داشبورد >  کاربران
 Breadcrumbs::for('users', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('کاربران', route('admin.users.index'));
});

 // داشبورد >  کاربران
 Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users', $trail);
    $trail->push('کاربر جدید', route('admin.users.create'));
});
 

//   < داشبورد >  کاربران ویرایش کاربر
 Breadcrumbs::for('users.edit', function ($trail,$user) {
    $trail->parent('users', $trail);
    $trail->push('ویرایش کاربر', route('admin.users.edit',$user));
});

 
  // داشبورد >  سطوح
  Breadcrumbs::for('leveles', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('سطوح', route('admin.levels.index'));
});

  // داشبورد >  سطوح >  ایجاد سطح جدید
  Breadcrumbs::for('leveles.create', function ($trail) {
    $trail->parent('leveles', $trail);
    $trail->push('ایجاد سطح جدید', route('admin.levels.create'));
});

  // داشبورد >  سطوح >  ایجاد سطح جدید
  Breadcrumbs::for('leveles.edit', function ($trail,$level) {
    $trail->parent('leveles', $trail);
    $trail->push('ویرایش سطح', route('admin.levels.edit',$level));
});


// داشبورد >  پرسش و پاسخ
Breadcrumbs::for('faq.index', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('پرسش و پاسخ', route('admin.faq.index'));
});


//  داشبورد >  پرسش و پاسخ > ایجاد پرسش و پاسخ جدید
Breadcrumbs::for('faq.create', function ($trail) {
    $trail->parent('faq.index', $trail);
    $trail->push('ایجاد پرسش و پاسخ', route('admin.faq.create'));
});

//  داشبورد >  پرسش و پاسخ > ایجاد ویرایش و پاسخ
Breadcrumbs::for('faq.edit', function ($trail,$faq) {
    $trail->parent('faq.index', $trail);
    $trail->push('ویرایش پرسش و پاسخ', route('admin.faq.edit',$faq));
});

  // داشبورد >  نقش ها
  Breadcrumbs::for('roles', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('نقش ها', route('admin.roles.index'));
});

  //  داشبورد >  نقش ها > ایجاد نقش جدید
  Breadcrumbs::for('roles.create', function ($trail) {
    $trail->parent('roles', $trail);
    $trail->push('ایجاد نقش جدید', route('admin.roles.create'));
});

 // ایجاد داشبورد >  نقش ها > ویرایش نقش
 Breadcrumbs::for('roles.edit', function ($trail,$role) {
    $trail->parent('roles', $trail);
    $trail->push('ویرایش نقش', route('admin.roles.edit',$role));
});

 // داشبورد >  نمابر
 Breadcrumbs::for('numbers', function ($trail) {
    $trail->parent('dashboard', $trail);
    $trail->push('نمابر', route('admin.numbers.index'));
});
