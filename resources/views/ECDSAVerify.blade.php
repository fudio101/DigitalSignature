<?php
/**
 * @author Fudio101
 * Date: 18/04/2022
 * Time: 10:23
 */
?>

@extends('main')
@section('ECDSA')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Verify With ECDSA(Elliptic Curve Digital Signature Algorithm)</h1>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content h-100">
            <div class="card card-primary card-outline shadow-lg p-3 mb-5 bg-body rounded">
                <div class="card-header">
                    <h4>Please Enter Text</h4>
                </div>
                <!-- /.card-header -->
                <form id="signForm">
                    <div class="card-body">
                        <div class="form-group h-25">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" class="form-control"></textarea>
                        </div>
                        <div class="form-group m-0">
                            <label for="publicKey">Public key</label>
                            <div class="input-group mb-3">
                                <input id="publicKey" name="publicKey" type="text" class="form-control"
                                       aria-label="Recipient's username" aria-describedby="button-addon2">
                            </div>
                        </div>
                        <div class="form-group m-0">
                            <label for="signature">Signature</label>
                            <div class="input-group mb-3">
                                <input id="signature" name="signature" type="text" class="form-control"
                                       aria-label="Recipient's username" aria-describedby="button-addon2">
                            </div>
                        </div>
                        <div id="result"></div>
                        <!-- /.card-body -->
                        <div class="card-footer border">
                            <button name="sign-btn" type="submit" class="btn btn-block btn-secondary btn-lg width-full">
                                <i
                                    class="fas fa-lock"></i>
                                VERIFY
                            </button>
                        </div>
                </form>
                <!-- /.card-footer -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    <!-- ./wrapper -->
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#signForm').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('ECDSAVerify')}}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function (data) {
                        if (data['result']) {
                            $('#result').html(`
                                <div class="alert alert-primary" role="alert">
                                Successful
                                </div>
                            `);
                        } else {
                            $('#result').html(`
                                <div class="alert alert-danger" role="alert">
                                Unsuccessful
                                </div>
                            `);
                        }
                    },
                    error: function (error) {
                        $('#result').html(`
                            <div class="alert alert-danger" role="alert">
                            Unsuccessful
                            </div>
                        `);
                    }
                });
            });
        });
    </script>
@endsection
