@extends('layout.app')
@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container">
            @foreach($developers as $key => $developer)
                <div class="card card-primary collapsed-card">
                    <div class="card-header" data-card-widget="collapse">
                        <h4 class="card-title">{{$developer->name}}</h4>
                    </div>
                    <div class="card-body" style="display: none;">
                        <ul class="nav nav-tabs" id="custom-content-below-tab-{{$key}}" role="tablist">
                            @foreach($developer->tasks as $key1 => $developerTask)
                                <li class="nav-item">
                                    <a class="nav-link {{$key1 == 0 ? 'active' : ''}}"
                                       id="custom-content-below-home-tab-{{$key . '-' . $key1}}"
                                       data-toggle="pill"
                                       href="#custom-content-below-home-{{$key . '-' . $key1}}" role="tab"
                                       aria-controls="custom-content-below-home-{{$key . '-' . $key1}}"
                                       aria-selected="true">{{$developerTask->task->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="custom-content-below-tab-{{$key}}Content">
                            @foreach($developer->tasks as $key1 => $developerTask)
                                <div class="card-body tab-pane fade {{$key1 == 0 ? 'active show' : ''}} "
                                     id="custom-content-below-home-{{$key . '-' . $key1}}"
                                     role="tabpanel"
                                     aria-labelledby="custom-content-below-home-tab-{{$key . '-' . $key1}}">
                                    <p>İşlerin Toplam Süresi: {{$developer->carts($developerTask->task_id)->sum('time')}} saat</p>
                                    <p>Ortalama Bitiş Süresi : {{job_calculation($developer->carts($developerTask->task_id)->sum('time'))}} hafta</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            @endforeach
        </div>
        <!-- /.card -->
    </div>
    <!-- /.content -->
@endsection
