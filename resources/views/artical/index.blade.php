@extends('layouts.loggedIn')

@section('title') {{__('Fact List')}} @endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">{{__('Facts')}} ({{$articals->total()}})</h3>
    </div>
</div>

@include('components.alert')

<div class="row">
    <div class="col-lg-12 text-right">
        <a href="{{route('create.artical')}}" class="btn btn-primary">{{__('Add Fact')}}</a>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>{{__('Sr')}}.</th>
                        <th>{{__('Fact')}}</th>
                        <th>{{__('Title')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = $articals->perPage() * ($articals->currentPage() - 1); @endphp
                    @foreach ($articals as $key => $value)
                        <tr class="odd gradeX">
                            <td>{{++$i}}</td>
                            <td>
                                    <div class="pictures-viewers">
                                         <img data-original="{{$value->image}}" src="{{$value->image}}" width="75px" height="50px" alt="{{$value->artical}}">
                                    </div>
                            </td>
                            <td>{{$value->title ?? '-'}}</td>
                            <td class="center">{{$value->is_active == '1' ? __('Active') : __('Deactive') }}</td>
                            <td>
                                <a href="{{route('show.artical',$value->id)}}" class="btn btn-sm btn-primary">{{__('Info')}}</a>
                                <button class="btn btn-sm btn-danger btn-dlt" data-id="{{$value->id}}">{{__('Delete')}}</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12 text-right">
        {{ $articals->links() }}
    </div>
</div>

 <!-- Modal -->
 <div class="modal fade" id="deleteModal" role="dialog">
    <div class="modal-dialog modal-md">
        <form class="form" action="{{route('delete.artical')}}" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{__('Delete Fact')}}</h4>
        </div>
        <div class="modal-body">
                @csrf
                {{ method_field('DELETE') }}
                 <input type="hidden" name="id" value="">
                 <p>{{__('Are you sure want to delete this fact?')}}</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Cancel')}}</button>
          <input type="submit" class="btn btn-danger" value="{{__('Delete')}}" />
        </div>
      </div>
    </form>
    </div>
  </div>
</div>

@endsection
@push('css')
  <link rel="stylesheet" href="{{asset('public')}}/css/viewer.css">
  <link rel="stylesheet" href="{{asset('public')}}/css/viewer_main.css">
  <style>
      img {
            display: block;
            max-width:230px;
            max-height:95px;
            width: auto;
            height: auto;
        }
  </style>
@endpush
@push('js')
  <script type="text/javascript" src="{{asset('public')}}/js/viewer.js"></script>
  <script type="text/javascript" src="{{asset('public')}}/js/viewer_main.js"></script>
  <script>
    $('.btn-dlt').on('click',function(e){
       $('#deleteModal').modal('show');
       $('#deleteModal input[name="id"]').val($(this).attr('data-id'));
    });
</script>
@endpush
