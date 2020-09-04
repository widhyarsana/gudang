@extends('layouts.master')

@section('title', 'Data Pegawai')

@section('style')
<script src="/assets/js/app.js" defer></script>
<script src="/global_assets/js/demo_pages/datatables_basic.js"></script>
<script src="/global_assets/js/demo_pages/components_modals.js"></script>
<!-- /theme JS files -->

@endsection

@section('header')
<div class="page-header border-bottom-0 pt-5">
     <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline border-0">
          <div class="d-flex">
               <div class="breadcrumb">
                    <a href="{{ route('dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <a href="{{ route('admin.employee.index') }}" class="breadcrumb-item">Pegawai</a>
               </div>

               <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
     </div>

     <br>
</div>
@endsection

@section('content')
<div class="content">

     <!-- Basic datatable -->
     <livewire:admin.employee.index> </livewire:admin.employee.index>
     
</div>
@endsection


@section('script')
    <script>
         window.livewire.on('employeeUpdated', ($employee) => {
              $('#form').modal('hide');
          });

          window.livewire.on('employeeStored', ($employee) => {
              $('#form').modal('hide');
          });
    </script>
@endsection