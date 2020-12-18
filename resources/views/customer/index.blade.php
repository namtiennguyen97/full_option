<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    {{--    font awesome--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous"/>
    {{--    end font awesome--}}

    {{--    dataTable--}}
    {{--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">--}}
    {{--endDATAtABLE--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
            integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj"
            crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


{{--    DataTable--}}
{{--    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>--}}
{{--end DataTable--}}

<!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    <title>Customer</title>
</head>
<body>
<h3 align="center">Customer Data
    <button id="addCustomer" class="btn btn-success">Create</button>
</h3>
<br>
<h2 align="center">Total Data found: <span id="total_data"></span></h2>
<br>
<input type="text" id="search" name="search" placeholder="Search customers" class="form-control">
<br>
<table id="mainTable" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Name</th>
        <th>Full Name</th>
        <th>Age</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Image</th>
        <th>Delete</th>
        <th>Edit</th>
    </tr>
    </thead>

    <tbody id="show_data">
    {{--    @foreach($customer as $value)--}}
    {{--        <tr>--}}
    {{--            <td>{{$value->name}}</td>--}}
    {{--            <td>{{$value->full_name}}</td>--}}
    {{--            <td>{{$value->age}}</td>--}}
    {{--            <td>{{$value->phone}}</td>--}}
    {{--            <td>{{$value->address}}</td>--}}
    {{--            <td><img src="storage/{{$value->image}}" width="100" class="img-thumbnail"></td>--}}
    {{--        </tr>--}}
    {{--        @endforeach--}}
    </tbody>
</table>


<!-- Modal ADD Customer -->
<div class="modal fade" id="modalAddCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Customer Data</h5>
                <button type="button" class="close" id="closeModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="customerAddForm" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-dark">
                        <tr>
                            <td>Name:</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="name" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Full Name:</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="full_name" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Age:</td>
                        </tr>
                        <tr>
                            <td><input type="number" name="age" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Phone:</td>
                        </tr>
                        <tr>
                            <td><input type="number" name="phone" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Address:</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="address" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Image</td>
                        </tr>
                        <tr>
                            <td><input type="file" accept="image/*" name="image" onchange="loadFile(event)"></td>
                        </tr>
                        <tr>
                            <td>Image Preview</td>
                        </tr>
                        <tr>
                            <td><img id="imagePreview" class="img-thumbnail"></td>
                        </tr>
                    </table>
                    <input type="submit" class="btn btn-success" value="Create Data">

                </form>
            </div>
        </div>
    </div>
</div>



{{--Modal Edit--}}
<div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal-editCustomer" id="exampleModalLabel">Edit Customer Data</h5>
                <button type="button" class="close" id="closeEditModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="customerEditForm" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-dark">
                        <tr>
                            <td>Name:</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="name" id="editName" class="form-control editName"></td>
                        </tr>
                        <tr hidden>
                            <td hidden><input readonly hidden id="editId"></td>
                        </tr>
                        <tr>
                            <td>Full Name:</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="full_name" id="editFullName" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Age:</td>
                        </tr>
                        <tr>
                            <td><input type="number" name="age" id="editAge" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Phone:</td>
                        </tr>
                        <tr>
                            <td><input type="number" name="phone" id="editPhone" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Address:</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="address" id="editAddress" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Image</td>
                        </tr>
                        <tr>
                            <td><input type="file" accept="image/*" name="image" id="editImage" onchange="loadEditFile(event)"></td>
                        </tr>
                        <tr>
                            <td>Current Image</td>
                        </tr>
                        <tr>
                            <td><img id="imageEditPreview" class="img-thumbnail"></td>
                        </tr>
                    </table>
                    <input type="submit" class="btn btn-success" value="Edit Data">

                </form>
            </div>
        </div>
    </div>
</div>





<script>


    $('#addCustomer').click(function () {
        $('#modalAddCustomer').modal('show');
    });
    $('#closeModal').click(function () {
        $('#modalAddCustomer').modal('hide');
    });

    $('#show_data').on('click','.editCustomer',function () {
        $('#editCustomerModal').modal('show');
        let id= $(this).data('id');
        let name = $(this).data('name');
        let full_name = $(this).data('full_name');
        let age = $(this).data('age');
        let address = $(this).data('address');
        let phone = $(this).data('phone');
        let image = $(this).data('image');
        $('#editName').val(name);
        $('#editFullName').val(full_name);
        $('#editAddress').val(address);
        $('#editAge').val(age);
        $('#editPhone').val(phone);
        $('#editId').val(id);
        // $('#editImage').val(image);

    });

    $('#closeEditModal').click(function(){
        $('#editCustomerModal').modal('hide');
    });

    // preview image before it uploaded

    function loadFile(event) {
        let output = document.getElementById('imagePreview');
        output.src = URL.createObjectURL(event.target.files[0]);
        //dong nay thi ko biet lam gi
        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        }
    }
 //end


    function loadEditFile(event) {
        let output = document.getElementById('imageEditPreview');
        output.src = URL.createObjectURL(event.target.files[0]);
        //dong nay thi ko biet lam gi
        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        }
    }

    //end preview image

    //create data customer
    $('#customerAddForm').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: "{{route('customer.create')}}",
            method: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                alertify.success('New Customer Data has been created!');
                // let total_data = data.length;
                // $('#total_data').text(total_data);

                reloadData();

            }
    });
    });

    //end create data

    //make/call fetch all data function
    fetch_customer_data();

    function fetch_customer_data(query = '') {
        $.ajax({
            url: "{{route('customer.searching')}}",
            method: 'get',
            data: {query: query},
            dataType: 'json',
            success: function (data) {
                $('#show_data').html(data.total_data);
                $('#total_data').text(data.total_column);

            }
        });
    }

    $(document).on('keyup', '#search', function () {
        let query = $(this).val();
        fetch_customer_data(query);
    });

    //end show data

    //delete customer
    $('#show_data').on('click','.deleteCustomer',function () {
        let id = $(this).data('id');
        $.ajax({
            url: "customer/destroy/"+ id,
            method: 'get',
            success: function (data) {
                reloadData();

                alertify.success('Deleted!');
            }
        })
    })

    //end delete customer

    //edit customer
    $('#customerEditForm').on('submit', function (e) {
        e.preventDefault();
        let id_edit = $('#editId').val();
            $.ajax({
               url: 'customer/edit/'+ id_edit ,
               method: 'post',
               data: $('#customerEditForm').serialize(),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    alert('ok');
                }
            });

    });


    reloadData();
       function reloadData() {
         $.ajax({
        url: "{{route('customer.data')}}",
        method: 'get',
        dataType: 'json',
        success: function (data) {
            $('#show_data').html(data.total_data);
            $('#total_data').text(data.total_column);
        }
        })
        }





</script>
</body>
<footer>


</footer>
</html>
