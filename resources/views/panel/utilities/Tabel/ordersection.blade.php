@extends('includes.sidepanel')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Order Section</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Order Section</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->
                        @foreach ($data as $order)
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-header">
                                    <div class="">{{ $order['order_id'] }}</div>
                                    <div class="">{{ $order['user_id'] }}</div>
                                    <div class="">{{ $order['order_total'] }}</div>
                                    <div class="">{{ $order['order_address'] }}</div>
                                    <div class="">{{ $order['order_status'] }}</div>
                                    <div class=""><a href="/order-section-status/{{ $order['order_id'] }}"
                                            class="btn btn-primary">Change Status</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-multi" style="overflow:scroll">
                                        <thead>

                                            <tr>
                                                @foreach ($config as $item)
                                                    <th>{{ $item['label'] }}</th>
                                                @endforeach
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        {{-- {{$section['products']}} --}}
                                        <tbody>
                                            @if (isset($order['section']))
                                                @foreach ($order['section'] as $item)
                                                    <tr>
                                                        <td>{{ $item['product']['product_name'] }}</td>
                                                        <td>{{ $item['product']['product_price'] }}</td>
                                                        <td>{{ $item['product']['product_merchantprice'] }}</td>
                                                        <td>{{ $item['product']['product_mrp'] }}</td>
                                                        <td>{{ $item['product']['product_description'] }}</td>
                                                        <td>{{ $item['product']['product_stockcount'] }}</td>
                                                        <td>{{ $item['isActive'] == 1 ? 'Active' : 'Deactive' }}
                                                        </td>
                                                        <td>
                                                            @foreach ($item['product']['documents'] as $document)
                                                                <img src="./documents/{{ $document['document_label'] }}/{{ $document['document_path'] }}"
                                                                    class="mt-2" alt="{{ $document['document_id'] }}"
                                                                    height="50px" width="50px">
                                                            @endforeach
                                                        </td>
                                                        {{-- <td>
                                                        </td> --}}
                                                    </tr>
                                                @endforeach
                                            @endif


                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        @endforeach
                    </div>

                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
