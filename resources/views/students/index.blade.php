@extends('layouts.web')
@section('content')
<div class="content">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h2 class="panel-title text-center">Students List</h2>
            </div>
            <div class="panel-body">
                <a href="{{ route('students.add') }}" class="btn btn-success m-btn m-btn--air m-btn--custom pull-right addproduct">
                    Add Student
                </a>
                <br>
                <div class="table-responsive"  style="width:100%">
                    <table class="table m-table m-table--head-bg-brand table-bordered table-collapsed" style="width:100%">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th>Student Name</th>
                                <th>Mobile</th>
                                <th>Gender</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>  

                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: 'http://localhost/laraveltask/api/studentsList',
                type: 'GET',
                dataType: 'json',
                success: function (data, textStatus, xhr) {

                    var items = '';
                    var x = 1;
                    $.each(data.data, function (i, item) {
                        var rows = "<tr>"
                                + "<td class='yourTableTh'>" + x + "</td>"
                                + "<td class='yourTableTh'>" + item.student_name + "</td>"
                                + "<td class='yourTableTh'>" + item.student_mobile + "</td>"
                                + "<td class='yourTableTh'>" + item.student_gender + "</td>"
                                + "<td class='text-center'>\n\
                    <a rel='tooltip' class='btn btn-secondary m-btn m-btn--air m-btn--custom' title='Edit Details' href='{{ route('students.edit') }}'><i class='fa fa-edit'></i></a>\n\
<a  date-value='" + item.student_id + "' class='delete btn btn-secondary m-btn m-btn--air m-btn--custom' href='javascript:void(0)'> <i class='fa fa-trash'></i></a></td>"
                                + "</tr>";
                        $('.table tbody').append(rows);
                        x++;
                    });

                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('Error in Database');
                }
            });
        });
        $(document).on('click', '.delete', function () {
            var id = $(this).data('data-value');
            $.ajax({
                url: 'http://localhost/laraveltask/api/deleteStudent',
                type: 'GET',
                dataType: 'json',
                data: id,
                success: function (data, textStatus, xhr) {
                    location.reload();
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log('Error in Database');
                }
            });
        });
    </script>  

    @endsection
