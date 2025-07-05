@extends('core::base.layouts.master')
@section('title')
    {{ translate('Licenses') }}
@endsection
@section('custom_css')
    <style>
        .backup-generate-btn {
            text-decoration: none;
            padding: 10px 20px;
            background: tomato;
            display: inline-flex !important;
            align-items: center;
            margin: 0;
            color: white;
        }

        .lds-ellipsis {
            display: inline-block;
            position: relative;
            width: 70px;
            height: 13px;
        }

        .lds-ellipsis div {
            position: absolute;
            top: 0px;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: #fff;
            animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }

        .lds-ellipsis div:nth-child(1) {
            left: 8px;
            animation: lds-ellipsis1 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(2) {
            left: 8px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(3) {
            left: 32px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(4) {
            left: 56px;
            animation: lds-ellipsis3 0.6s infinite;
        }

        @keyframes lds-ellipsis1 {
            0% {
                transform: scale(0);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes lds-ellipsis3 {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(0);
            }
        }

        @keyframes lds-ellipsis2 {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(24px, 0);
            }
        }
    </style>
@endsection
@section('main_content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card">
                <div class="card-header bg-white  py-3">
                    <h4>{{ translate('Licenses') }}</h4>
                </div>
                <div class="card-body">
                    @if ($license != null)
                        {{-- @php   dd($license); @endphp --}}
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="bg-dark-light info-wapper p-3 rounded">
                                    <h4 class="h4 mb-2">{{ translate('License Details') }}</h4>
                                    <p><span class="bold">{{ translate('License') }} :</span> {{ $license->license_key }}
                                    </p>
                                    <p><span class="bold">{{ translate('License Type') }} :</span>
                                        {{ $license->license_title }}</p>
                                    <p><span class="bold">{{ translate('Expire Date') }} :</span>
                                        {{ $license->expire_date }}</p>
                                    <p><span class="bold">{{ translate('Support End') }} :</span>
                                        {{ $license->support_end }}</p>
                                    <p><span class="bold">{{ translate('License Status') }} :</span>
                                        @if ($license->is_valid)
                                            <span class="badge badge-success">{{ translate('Validated') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ translate('Invalid') }}</span>
                                        @endif
                                    </p>

                                    <button class="btn btn-long" data-toggle="modal"
                                        data-target="#delete-modal">{{ translate('Remove License') }}</button>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="alert alert-danger text-center">{{ translate('No License Found') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
<!--Delete Modal-->
<div id="delete-modal" class="delete-modal modal fade show" aria-modal="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title h6">{{ translate('Remove Confirmation') }}</h4>
            </div>
            <div class="modal-body text-center">
                <p class="mt-1">{{ translate('Are you sure to remove this license') }}?</p>
                <form method="POST" action="{{ route('app.system.license.remove') }}">
                    @csrf
                    <button type="button" class="btn long mt-2 btn-danger"
                        data-dismiss="modal">{{ translate('cancel') }}</button>
                    <button type="submit" class="license-remove-btn btn long mt-2">{{ translate('Remove') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Delete Modal-->
@section('custom_scripts')
    <script type="application/javascript">
        (function($) {
            "use strict";
        })(jQuery);
    </script>
@endsection
