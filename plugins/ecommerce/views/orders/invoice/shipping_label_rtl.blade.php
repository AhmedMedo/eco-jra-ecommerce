<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ======= MAIN STYLES ======= -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('web-assets/backend/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web-assets/backend/fonts/roboto/roboto.css') }}">
    <style>
        @font-face {
            font-family: "Arabic";
            src: url("https://tlcommerce.themelooks.uscdn/font/arabic.ttf") format('truetype');
        }

        @font-face {
            font-family: "Bangla";
            src: url("https://tlcommerce.themelooks.uscdn/font/Nikosh.ttf") format('truetype');
        }

        @font-face {
            font-family: "Hibrew";
            src: url("https://tlcommerce.themelooks.uscdn/font/Hebrew.ttf") format('truetype');
        }

        @font-face {
            font-family: "Arial Unicode MS";
            src: url("https://tlcommerce.themelooks.uscdn/font/arial-unicode-ms.ttf") format('truetype');
        }

        body {
            font-family: '{{ $font_family }}', sans-serif;
            line-height: 20px;
        }

        tr {
            text-align: right;
        }

        .big-barcode {
            height: 190px;
        }

        .small-barcode {
            height: 100px;
        }

        .qr-code {
            min-height: 200px;
        }

        .border-bottom-1 {
            border-bottom: 1px solid #dee2e6 !important;
        }

        .border-right-1 {
            border-right: 1px solid #dee2e6 !important;
        }

        .currency {
            font-family: '{{ $currency_font }}', sans-serif;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>{{ $order_info['date'] }}</td>
                        <td>
                            <p class="mb-0">{{ $order_info['order_code'] }}</p>
                            <p class="mb-0">{{ translate('Order Number', getLocale()) }}</p>
                        </td>
                        <td>
                            @if ($order_info['system_properties']['logo'] != null)
                                <img src="{{ asset('/') }}{{ $order_info['system_properties']['logo'] }}"
                                    alt={{ $order_info['system_properties']['title'] }}>
                            @else
                                <h2>{{ $order_info['system_properties']['title'] }}</h2>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <img src="data:image/png;base64, {!! $tracking_id_bar_code !!}" class="w-100 small-barcode">
                            <p class="mb-0 text-center">{{ $order_info['tracking_id'] }}
                                {{ translate('Tracking Number', getLocale()) }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-0">
                            <table class="w-100">
                                <tr>
                                    <td class="border-0 border-bottom-1">
                                        {{ $order_info['shipping_zone'] != null ? $order_info['shipping_zone'] : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-0 border-bottom-1">
                                        {{ $order_info['shipping_type'] != null ? $order_info['shipping_type'] : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-0 border-bottom-1">
                                        {{ $order_info['shipping_method'] != null ? $order_info['shipping_method'] : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-0 border-bottom-1">{{ $order_info['payment_method'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-0 currency">
                                        {{ currencyExchange($order_info['total_payable_amount'], true, null, false) }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td colspan="2">
                            <img src="data:image/png;base64, {!! $order_code_bar_code !!}" class="w-100 big-barcode">
                            <p class="mb-0 text-center">{{ translate('Order Number', getLocale()) }}
                                {{ $order_info['order_code'] }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-0" colspan="2">
                            <table class="w-100">
                                <tr>
                                    <td class="border-0 border-bottom-1" colspan="2">
                                        @if ($order_info['shipping_info'] != null)
                                            <p class="mb-0">

                                                ({{ $order_info['shipping_info']['phone'] }}:{{ translate('Tel', getLocale()) }})-
                                                {{ $order_info['shipping_info']['name'] }}
                                                :{{ translate('Recipient', getLocale()) }}
                                                <br>
                                                {{ $order_info['shipping_info']['address'] }},
                                                {{ $order_info['shipping_info']['city'] }},
                                                {{ $order_info['shipping_info']['state'] }},
                                                {{ $order_info['shipping_info']['country'] }}<br>
                                                {{ $order_info['shipping_info']['postal_code'] }}
                                                :{{ translate('Postal Code', getLocale()) }}
                                            </p>
                                        @else
                                            {{ $order_info['customer_name'] }}
                                            :{{ translate('Recipient', getLocale()) }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-0 border-bottom-1" colspan="2">
                                        <p class="mb-0">
                                            {{ translate('Seller', getLocale()) }}:{{ $order_info['system_properties']['title'] }}:
                                            ({{ $order_info['system_properties']['phone'] }}:{{ translate('Tel', getLocale()) }})-
                                            {{ $order_info['system_properties']['address'] }},
                                            {{ $order_info['system_properties']['email'] }}
                                        </p>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-0 border-bottom-1" colspan="2">
                                        {{ translate('kg', getLocale()) }}
                                        {{ $order_info['total_product_weight'] }}
                                        {{ translate('Total Weight', getLocale()) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-0" colspan="2">
                                        {{ $order_info['num_of_products'] }}
                                        {{ translate('Number of Products', getLocale()) }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <img src="data:image/png;base64, {!! $qr_code !!}" class="w-100 qr-code">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
