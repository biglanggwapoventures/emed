@extends('welcome') @section('body')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Roles Form
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Add User Roles</a></li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="inside">
                       <h3>Create Roles</h3>

    <form action="#" method="post" role="form">
        {{csrf_field()}}

        <div class="form-group">
             {!! Form::bsText('name', 'Role Name') !!}
        </div>
        <div class="form-group">
              {!! Form::bsText('namedisplay', 'Display Name') !!}
        </div>
        <div class="form-group">
              {!! Form::bsText('description', 'Description') !!}
        </div>

        <div class="form-group text-left">
        <!--  But i foreach ni sila when we add roles -->
        <div class="box-body table-responsive no-padding">
            <h3>Sample permissions</h3>
           <table class="table table-bordered" >
            <thead>
                <tr>
                    <th>Add</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
               <tbody>
                   <tr>
                       <td><input type="checkbox"   name="1" value="#" > Add Doctor </td>
                       <td><input type="checkbox"   name="1" value="#" > View Doctor Profile</td>
                       <td><input type="checkbox"   name="1" value="#" > Edit Doctor </td>
                       <td><input type="checkbox"   name="1" value="#" > Delete Doctor</td>
                   </tr>
                    <tr>
                       <td><input type="checkbox"   name="1" value="#" > Add Pharmacist </td>
                       <td><input type="checkbox"   name="1" value="#" > View Pharmacist Profile</td>
                       <td><input type="checkbox"   name="1" value="#" > Edit Pharmacist </td>
                       <td><input type="checkbox"   name="1" value="#" > Delete Pharmacist</td>
                   </tr>
                    <tr>
                       <td><input type="checkbox"   name="1" value="#" > Add Pharmacy Manager </td>
                       <td><input type="checkbox"   name="1" value="#" > View Manager Profile</td>
                       <td><input type="checkbox"   name="1" value="#" > Edit Manager </td>
                       <td><input type="checkbox"   name="1" value="#" > Delete Manager</td>
                   </tr>
                    <tr>
                       <td><input type="checkbox"   name="1" value="#" > Add Patient </td>
                       <td><input type="checkbox"   name="1" value="#" > View Patient Profile</td>
                       <td><input type="checkbox"   name="1" value="#" > Edit Patient </td>
                       <td><input type="checkbox"   name="1" value="#" > Delete Patient</td>
                   </tr>
                    <tr>
                       <td><input type="checkbox"   name="1" value="#" > Add Secretary </td>
                       <td><input type="checkbox"   name="1" value="#" > View Secretary </td>
                       <td><input type="checkbox"   name="1" value="#" > Edit Secretary </td>
                       <td><input type="checkbox"   name="1" value="#" > Delete Secretary</td>
                   </tr>
                   <tr>
                       <td><input type="checkbox"   name="1" value="#" > Add Other User </td>
                       <td><input type="checkbox"   name="1" value="#" > View Other Users </td>
                       <td><input type="checkbox"   name="1" value="#" > Edit Other Users </td>
                       <td><input type="checkbox"   name="1" value="#" > Delete Secretary</td>
                   </tr>
                    <tr>
                       <td><input type="checkbox"   name="1" value="#" > Add Specialization </td>
                       <td><input type="checkbox"   name="1" value="#" > View Specialization</td>
                       <td><input type="checkbox"   name="1" value="#" > Edit Specialization </td>
                       <td><input type="checkbox"   name="1" value="#" > Delete Specialization</td>
                   </tr>
                    <tr>
                       <td><input type="checkbox"   name="1" value="#" > Add Organization </td>
                       <td><input type="checkbox"   name="1" value="#" > View Organization</td>
                       <td><input type="checkbox"   name="1" value="#" > Edit Organization </td>
                       <td><input type="checkbox"   name="1" value="#" > Delete Organization</td>
                   </tr>
                   <tr>
                       <td><input type="checkbox"   name="1" value="#" > Add Drugstore </td>
                       <td><input type="checkbox"   name="1" value="#" > View Drugstores</td>
                       <td><input type="checkbox"   name="1" value="#" > Edit Drugstore </td>
                       <td><input type="checkbox"   name="1" value="#" > Delete Drugstore</td>
                   </tr>
                   <tr>
                       <td><input type="checkbox"   name="1" value="#" > Add Affiliations </td>
                       <td><input type="checkbox"   name="1" value="#" > View Affiliations</td>
                       <td><input type="checkbox"   name="1" value="#" > Edit Affiliations </td>
                       <td><input type="checkbox"   name="1" value="#" > Delete Affiliations</td>
                   </tr>
                   <tr>
                       <td><input type="checkbox"   name="1" value="#" > Add Consultation </td>
                       <td><input type="checkbox"   name="1" value="#" > View Consultation</td>
                       <td><input type="checkbox"   name="1" value="#" > Edit Consultation </td>
                       <td><input type="checkbox"   name="1" value="#" > Delete Consultation</td>
                   </tr>
                   <tr>
                       <td><input type="checkbox"   name="1" value="#" > Add Prescription </td>
                       <td><input type="checkbox"   name="1" value="#" > View Prescription</td>
                       <td><input type="checkbox"   name="1" value="#" > Edit Prescription </td>
                       <td><input type="checkbox"   name="1" value="#" > Delete Prescription</td>
                   </tr>

               </tbody>
            </table>
           </div>
           

        </div>






        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

                    </div>
                    <!-- /.box -->
                </div>


            </div>
            <!--/.col (left) -->

            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<style type="text/css">
    .inside {
        padding: 12px;
    }

</style>


@endsection
