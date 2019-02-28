@extends('Qcalendar::layout')

@section('content')
<section class="content">
  <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <div class="box-title"><h3 class="box-title"><strong>{{ $event->name }}</strong></h3>  {{ $event->start_at }} @if($event->start_at != $event->end_at) - {{ $event->end_at }} @endif</div>
              <div class="box-tools pull-right"><a class='btn btn-warning btn-sm' href="/">Изменить</a> <a href="/" class='btn btn-danger btn-sm'>Удалить</a></div>
            </div>
            <div class="box-body pad table-responsive">
              @if($event->description)
              <b>Описание:</b><br />
                <p>{{ $event->description }}</p>
              @endif

              @if($event->has('files'))
              <b>Описание:</b><br />
                <p>{{ $event->description }}</p>
              @endif

            </div>
            <!-- /.box -->
          </div>
        </div>
        <!-- /.col -->
      </div>
          <!-- /.box -->
</section>

@endsection