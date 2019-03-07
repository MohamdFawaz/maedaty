@extends('backend.layouts.default')
@section('content')

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">


    <div class="row" style="padding: 10px">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <form class="tocify-content" action="{{route('backend.products.store')}}" method="POST" enctype="multipart/form-data">
                        {{ method_field('POST') }}
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name_ar">{{trans('backend.products.name_ar')}}</label>
                            <input type="text" name="name_ar" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="name_en">{{trans('backend.products.name_en')}}</label>
                            <input type="text" name="name_en" class="form-control" required>
                        </div>
                            <h2>{{trans('backend.products.image')}}</h2>
                            <div class="image-upload friend" >
                                <label for="file-input" class="image-upload-label">
                                    <img src="{{asset('public/images/products/no-product.png')}}" class="thumb"/>
                                </label>
                                <input name="product_image" id="file-input" type="file"/>
                            </div>


                        <div class="form-group">
                        <label for="description_ar">{{trans('backend.products.description_ar')}}</label>
                        <textarea name="description_ar" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="description_en">{{trans('backend.products.description_en')}}</label>
                            <textarea name="description_en" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="shop_id">{{trans('backend.products.shop')}}</label>
                            <select name="shop_id" id="shop_id" class="form-control"  @if(Auth()->user()->hasRole('Store Admin')) readonly="" @endif required>
                                <option>{{trans('backend.select.choose')}}</option>
                                @foreach($shops as $shop)
                                <option value="{{$shop->id}}" @if(Auth()->user()->shop != null) @if(Auth()->user()->shop->id == $shop->id) selected @else disabled @endif @endif>{{$shop->translate(app()->getLocale())->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category_id">{{trans('backend.products.category')}}</label>
                            <select name="category_id" class="form-control " required>
                                <option>{{trans('backend.select.choose')}}</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->translate(app()->getLocale())->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subcategory_id">{{trans('backend.products.subcategory')}}</label>
                            <select name="subcategory_id" class="form-control " required>
                                <option>{{trans('backend.select.choose')}}</option>
                                @foreach($subcategory as $category)
                                    <option value="{{$category->id}}" >{{$category->translate(app()->getLocale())->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="price">{{trans('backend.products.price')}}</label>

                        <div class="form-group">
                            <input type="number" name="price" class="form-control" min="1" required>
                            <div class="checkbox">
                                <label><input type="checkbox" id="has_offer">{{trans('backend.products.has_discount')}}</label>
                            </div>
                            <div class="discount-box row hidden">
                                    <div class="col-md-3">
                                        <input type="number" name="discounted_price" class="form-control" placeholder="{{trans('backend.products.enter_the_new_price')}}">
                                    </div>
                                    <div class="col-md-3">
                                    <input type="date" name="from_date" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" name="to_date" class="form-control">
                                    </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="product_stock">{{trans('backend.products.product_stock')}}</label>
                            <input type="number" name="product_stock" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="product_images">{{trans('backend.products.images')}}</label>
                            <input type="file" name="product_images[]" multiple="multiple" class="form-control">
                        </div>
                        <input type="submit" class="btn btn-success" value="{{trans('backend.action.create')}}">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3" style="position: relative;">
            <div id="tocify"></div>
        </div>
    </div>

    <!-- END PAGE CONTENT WRAPPER -->
    <!-- MESSAGE BOX-->
    <div class="message-box message-box-danger animated fadeIn" data-sound="alert" id="mb-delete-product">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-sign-out"></span>  <strong>{{trans('backend.action.delete')}}</strong> ?</div>
                <div class="mb-content">
                    <p>{{trans('backend.question.are_you_sure_delete')}}</p>
                </div>
                <div class="mb-footer">
                    <div class="pull-right">
                        <a href="#" class="btn btn-success btn-lg">{{trans('backend.action.yes')}}</a>
                        <button class="btn btn-default btn-lg mb-control-close">{{trans('backend.action.no')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">

        $(".status").change(function(){
            var product_id=$(this).attr('id');
            var status_val=$(this).attr('value');
            if(status_val==0)
            {
                status_val=1;
                $('#'+product_id).val("1");
            }else{
                status_val=0;
                $('#'+product_id).val("0");
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('{{url()->current()."/updateStatus"}}',
                {product_id:product_id,status:status_val},
                function(data){
                    if(data.success){
                        if(data.status == 1){
                            $("#label-"+product_id).toggleClass('label-danger label-success');
                            $("#label-"+product_id).html('{{trans('backend.products.active')}}');
                        }else{
                            $("#label-"+product_id).toggleClass('label-danger label-success');
                            $("#label-"+product_id).html('{{trans('backend.products.not_active')}}');
                        }
                    }
            });
        });
        // $(".image-upload-label").click(function(){
        //     $(".image-upload-label").addClass("hidden");
        // });
        $("#has_offer").change(function(){
            if(this.checked){
                $(".discount-box").removeClass("hidden");
            }else{
                $(".discount-box").addClass("hidden");
            }
        });
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.thumb').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#file-input").change(function() {
            readURL(this);
        });
    </script>
    <!-- THIS PAGE PLUGINS -->
    <script type='text/javascript' src="{{asset('public/js/plugins/icheck/icheck.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- END PAGE PLUGINS -->

@endsection







