@extends('includes.sidepanel')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Form</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">
                                    @if (!empty($title))
                                        {{ $title }}
                                    @endif
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div style="display: flex">
                                @foreach ($formConfig as $item)
                                    @if ($item['type'] == 'documents')
                                        @foreach ($item['documentList'] as $document)
                                            <form style="display:inline-flex"
                                                action="{{ config('app.APP_URL') }}/delete-document" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$document['document_id']}}">
                                                <button type="submit" class="btn" style="display: inline;">

                                                    <img src="{{ config('app.APP_URL') }}/documents/{{ $document['document_label'] }}/{{ $document['document_path'] }}"
                                                        alt="" height="75px" width="75px" srcset="">
                                                </button>
                                            </form>
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                            <form action="@if ($action) {{ $action }} @endif"
                                method="{{ $method }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @foreach ($formConfig as $item)
                                        @if ($item['type'] != 'documents')
                                            @if ($item['type'] == 'hidden')
                                                <input type="{{ $item['type'] }}" class="form-control"
                                                    name="@if(!empty($item['name'])){{$item['name']}}@endif"
                                                    id="@if(!empty($item['id'])){{$item['id']}}@endif"
                                                    placeholder="@if (!empty($item['placeholder'])) {{$item['placeholder']}} @endif"
                                                    @if (!empty($item['value'])) value="{{$item['value']}}" @endif>
                                            @elseif($item['type'] == 'option')
                                            <div class="form-group">
                                                <label
                                                        for="@if (!empty($item['id'])) {{ $item['id'] }} @endif">
                                                        @if (!empty($item['label']))
                                                            {{ $item['label'] }}
                                                        @endif
                                                    </label>
                                                   
                                                <select class="custom-select form-control-border" id="exampleSelectBorder" name="@if(!empty($item['name'])){{$item['name']}}@endif"
                                                id="@if(!empty($item['id'])){{$item['id']}}@endif">
                                                
                                                    @foreach ($item['optionSet'] as $option)
                                                    {{$option[$item['optionValue']]}}-{{$item['value']}}
                                                        <option value="{{$option[$item['optionValue']]}}" @if($option[$item['optionValue']] == $item['value']) selected="true" @endif>{{$option[$item['optionLabel']]}}</option>
                                                    @endforeach
                                                 
                                                </select>
                                              </div>
                                            @else
                                                <div class="form-group">
                                                    <label
                                                        for="@if (!empty($item['id'])) {{ $item['id'] }} @endif">
                                                        @if (!empty($item['label']))
                                                            {{ $item['label'] }}
                                                        @endif
                                                    </label>
                                                    <input type="{{ $item['type'] }}" class="form-control"
                                                        name="@if(!empty($item['name'])){{$item['name']}}@endif"
                                                        id="@if(!empty($item['id'])){{$item['id']}}@endif"
                                                        placeholder="@if (!empty($item['placeholder'])) {{$item['placeholder']}} @endif"
                                                        @if (!empty($item['value'])) value="{{$item['value']}}" @endif>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                        </div>
                        <!-- /.card -->



                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->

                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
