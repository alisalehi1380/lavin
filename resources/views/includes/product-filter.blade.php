
<form id="filter-product-{{ $id }}-form" class="w-100 p-3 bg-light border rounded min-h-mobile-100">
    <div>
        <small>نام محصول</small>
        <div>
            <input type="text" name="name" placeholder="لطفا نام محصول را وارد کنید" class="w-100 px-2" value="{{ request('name') }}">
        </div>
    </div>
    <div class="mt-3">
        <small>نام دسته</small>
        <div>
            <select name="category" class="w-100 py-1" onchange="sender(this.value)">
                <option value="-1">همه دسته‌بندی ها</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"  {{ $category->id==request('category')?'selected':'' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mt-3">
        <small>نام زیردسته</small>
        <div>
            <select name="child" class="w-100 py-1"></select>
        </div>
    </div>
    <div class="mt-3">
        <small>مرتب براساس</small>
        <div>
            <select name="sort" class="w-100 py-1" id="sort">
                <option value="{{ App\Enums\ProductSortType::Newests }}"  {{ App\Enums\ProductSortType::Newests==request('sort')?'selected':'' }}>جدید ترین‌ها</option>
                <option value="{{ App\Enums\ProductSortType::Cheapests }}" {{ App\Enums\ProductSortType::Cheapests==request('sort')?'selected':'' }}>ارزان‌ترین‌ها</option>
                <option value="{{ App\Enums\ProductSortType::MostExpinsives }}" {{ App\Enums\ProductSortType::MostExpinsives==request('sort')?'selected':'' }}>گران‌ترین‌ها</option>s
            </select>
        </div>
    </div>
    <div class="text-center d-flex justify-content-center my-3 px-0">
        <button data-dismiss="modal" class="btn w-50 btn-light pointer mt-3 mx-1 d-md-none">بازگشت</button>
        <button type="submit" class="btn w-50 btn-accent-outline pointer mt-3 mx-1">جستجو کن!</button>
    </div>
</form>
@once
@push('js')
    <script>

        $(document).ready(function () {

            let id = $('select[name=category]').val();

            sender(id);

            @if(request('child'))

            setTimeout(()=>{

                $('select[name=child]').val('{{ request('child') }}');

            },1000);

            @endif
        })

        function sender(cat){
            // remove the past options for subcat
            $('select[name=child]').empty();

            // axios for subcategory
            axios.post('{{ route('website.subcat') }}' ,{
                category: cat
            }).then(res => {
                if(res.status === 200){

                    let data_options = res.data.sub;

                    data_options.map(item => {
                        $('select[name=child]').append($('<option>', {
                            value: item.id,
                            text : item.name
                        }));
                    });
                }
            }).catch(err => {
                console.log(err.response.data)
            })
        }

    </script>
@endpush
@endonce

