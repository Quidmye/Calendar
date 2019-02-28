@extends('Qcalendar::layout')

@section('content')
<section class="content">
  <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">{{ $event->name }}</h3>{{ $event->start_at }} @if($event->start_at != $event->end_at) - {{ $event->end_at }} @endif
            </div>
            <div class="box-body pad table-responsive">
              @if($event->description)
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
