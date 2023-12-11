<x-app-layout>
    <!--sidebar wrapper -->
    @include('inc.sidebar')
    <!--end sidebar wrapper -->

    <!--start header -->
    @include('inc.header')
    <!--end header -->

    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Product</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="row row-cols-1 row-cols-1">
                <div class="col">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-user me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Edit Product Details</h5>
                            </div>
                            <hr>
                            <form class="row g-3" method="POST" action="{{ route('products.update',$product->id) }}" id="add-member-form">
                                @csrf
                                @method('PUT')
                                <div class="col-md-3">
                                    <label for="introducer_id" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" value="{{$product->product_name}}" name="product_name" placeholder="Product Name">
                                </div>

                                <div class="col-md-3">
                                    <label for="inputMenberName" class="form-label">Loading Point</label>
                                    <input type="text" class="form-control" value="{{$product->loading_point}}" name="loading_point" placeholder="Loading Point">
                                </div>

                                <div class="col-md-3">
                                    <label for="inputEmail" class="form-label">Broker Price</label>
                                    <input type="text" class="form-control" value="{{$product->broker_price}}" name="broker_price" placeholder="Broker Price">
                                </div>

                                <div class="col-md-3">
                                    <label for="inputDate" class="form-label">Client Price</label>
                                    <input type="text" class="form-control" value="{{$product->client_price}}" name="client_price" placeholder="Client Price">
                                </div>

                                <div class="col-md-3">
                                    <label for="inputMobile" class="form-label">From Date</label>
                                    <input type="date" class="form-control" value="{{$product->from_date}}" name="from_date">
                                </div>

                                <div class="col-md-3">
                                    <label for="inputPassword" class="form-label">To date</label>
                                    <input type="date" class="form-control" value="{{$product->to_date}}" name="to_date">
                                </div>                 
                                
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
    @include('inc.footer')
</x-app-layout>