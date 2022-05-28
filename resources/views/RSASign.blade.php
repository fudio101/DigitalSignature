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
                        <h1 class="m-0">Sign With RSA (Rivest Shamir Adleman)</h1>
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
                            <label for="privateKey">Private key</label>
                            <div class="input-group mb-3">
                                <textarea id="privateKey" name="privateKey" type="text" class="form-control"></textarea>
                                <button class="btn btn-secondary" onclick="generateKey()" type="button"
                                        id="button-generate">Generate
                                </button>
                            </div>
                        </div>
                        <div id="result"></div>
                        <!-- /.card-body -->
                        <div class="card-footer border">
                            <button name="sign-btn" type="submit" class="btn btn-block btn-secondary btn-lg width-full">
                                <i
                                    class="fas fa-lock"></i>
                                SIGN
                            </button>
                        </div>
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
                    url: "{{route('RSASignatureSign')}}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function (data) {
                        if (!data['error']) {
                            $('#result').html(`
                            <div class="form-group m-0">
                                <label for="signature">Hash value</label>
                                <div class="input-group mb-3">
                                    <input id="hashValue" type="text" class="form-control"
                                           aria-describedby="button-addon2" disabled value="${data['hashValue']}">
                                    <button class="btn btn-secondary" type="button" onclick="copy('hashValue')"> Copy</button>
                                </div>
                            </div>
                            <div class="form-group m-0">
                                <label for="signature">Signature</label>
                                <div class="input-group mb-3">
                                    <input id="signature" type="text" class="form-control"
                                           aria-describedby="button-addon2" disabled value="${data['signature']}">
                                    <button class="btn btn-secondary" type="button" onclick="copy('signature')"> Copy</button>
                                </div>
                            </div>
                            <div class="form-group m-0">
                                <label for="publicKey">Public key</label>
                                <div class="input-group mb-3">
                                    <textarea id="publicKey" type="text" class="form-control"
                                        aria-describedby="button-addon2" disabled>${data['publicKey']}</textarea>
                                    <button class="btn btn-secondary" type="button" onclick="copy('publicKey')"> Copy</button>
                                </div>
                            </div>
                        `);
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });

        function generateKey() {
            $.ajax({
                type: "POST",
                url: "{{route('RSASignatureGenKey')}}",
                success: (data) => {
                    $("#privateKey").val(data.key);
                }
            });
        }
    </script>
@endsection
