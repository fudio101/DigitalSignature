<?php
/**
 * @author Fudio101
 * Date: 18/04/2022
 * Time: 10:23
 */
?>

@extends('main')
@section('sign')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Sign With Rivest–Shamir–Adleman</h1>
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
                <form action="">
                    <div class="card-body">
                        <div class="form-group h-25">
                            <textarea id="compose-textarea" class="form-control"></textarea>
                        </div>
                        <div class="form-group m-0">
                            <label>Private key</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control"
                                       aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-secondary" type="button" id="button-generate-RSA">Generate
                                </button>
                            </div>
                        </div>
                        <div class="form-group m-0">
                            <label>Signature</label>
                            <div class="input-group mb-3">
                                <div class="input-group mb-3">
                                    <input id="signtext" type="text" class="form-control"
                                           aria-describedby="button-addon2" value="Hello">
                                    <button onclick="copyToClipboard()" class="btn btn-secondary" type="button"
                                    >Copy
                                    </button>
                                </div>
                            </div>
                            <div class="form-group m-0">
                                <label>Public key</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control"
                                           aria-describedby="button-addon2" disabled value="aloô">
                                    <button class="btn btn-secondary" type="button" id="button-copy2">Copy</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer border">
                            <button name="sign-btn" type="button" class="btn btn-block btn-secondary btn-lg width-full">
                                <i class="fas fa-lock"></i>SIGN
                            </button>
                        </div>
                    </div>
                </form>
                <!-- /.card-footer -->
            </div>

        </section>
        <!-- /.content -->

        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>


@endsection
