<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quotation</title>

    <style>
        .text_fonts th {
            font-size: 12px;
            /* font-weight: 100; */
            text-align: center;
        }

        .footer_span {
            display: grid;
        }

        footer {
            position: fixed;
            bottom: -2px;
            left: 0px;
            right: 0px;
            text-align: center;
            height: auto;
            width: fit-content;
            padding-left: 2.5rem;
            padding-right: 2.5rem;
            /* background: white; */
            padding-top: 1rem;
        }

        footer .pagenum:before {
            content: counter(page);
        }
    </style>
</head>

<body style="margin-top: 0 !important; margin-bottom: 0 !important;">
    <footer style="width: inherit; z-index: 1212;">

        <table style="border: none">
            <tr style="border: none;">
                <td style="text-align: left !important; width: 50%; border: none;padding-left: 0px;">
                    <div style="border: none;">
                        <div>
                            <span style="text-align: left !important;">UAN: 0310 5845 840</span>
                        </div>
                        <div>
                            <span style="text-align: left !important;">www.b2doormarketing.com</span>
                        </div>
                        <div>
                            <span style="text-align: left !important;">b2doormarketing@gmail.com</span>
                        </div>
                        <div>
                            <span style="text-align: left !important;">G-10 Markaz Islamabad</span>
                        </div>
                    </div>
                </td>
                <td style="text-align: right; width: 50%; border: none;">

                    <img src="data:image/png;base64,{{ $footerImage }}" width="150" alt="">
                </td>
            </tr>
        </table>
    </footer>

    <h2 style="text-align: center; text-transform:uppercase;">Business to Door Marketing</h2>
    <br>
    <h3 style="text-align: center; text-transform:capitalize;">Quotation for {{ $data['name'] }}</h3>

    <div class="invoice-box"
        style="max-width: 800px;margin: auto;padding: 30px;border: 1px solid #eee;box-shadow: 0 0 10px rgba(0, 0, 0, .15);font-size: 16px;line-height: 24px;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;color: #555;">
        <table cellpadding="0" cellspacing="0" style="width: 100%;line-height: inherit;text-align: left;">

            @if ($data['type'] === 'paper_media')
                <tr class="heading" style="padding-left: 10px !important;">
                    <td
                        style="padding: 5px;vertical-align: top;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold; !important;padding-left: 10px !important; text-align:left !important; padding-left: 10px !important;">
                        Selections
                    </td>

                    <td
                        style="padding: 5px;vertical-align: top;text-align: right;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold; text-align:left !important; padding-left: 10px !important;">
                        Details
                    </td>
                </tr>

                <tr class="item">
                    <td
                        style="padding: 5px;vertical-align: top;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        Area Selected
                    </td>

                    <td
                        style="padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        {{ isset($data['location']) ? $data['location'] : '' }}
                    </td>
                </tr>

                <tr class="item">
                    <td
                        style="padding: 5px;vertical-align: top;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        Paper Type
                    </td>

                    <td
                        style="padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        {{ isset($data['paper_type']) ? $data['paper_type'] : '' }}
                    </td>
                </tr>

                <tr class="item">
                    <td
                        style="padding: 5px;vertical-align: top;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        Sides to Print
                    </td>

                    <td
                        style="padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        {{ isset($data['printSides']) ? $data['printSides'] : '' }}
                    </td>
                </tr>

                <tr class="item">
                    <td
                        style="padding: 5px;vertical-align: top;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        Paper Quality
                    </td>

                    <td
                        style="padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        {{ isset($data['paper_quality']) ? $data['paper_quality'] : '' }}
                    </td>
                </tr>

                <tr class="item">
                    <td
                        style="padding: 5px;vertical-align: top;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        Distribution Type
                    </td>

                    <td
                        style="padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        {{ isset($data['distribution_type']) ? $data['distribution_type'] : '' }}
                    </td>
                </tr>

                <tr class="item">
                    <td
                        style="padding: 5px;vertical-align: top;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        Distribution Duaration
                    </td>

                    <td
                        style="padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        {{ isset($data['distribution_duration']) ? $data['distribution_duration'] : '' }}
                    </td>
                </tr>

                <tr class="item">
                    <td
                        style="padding: 5px;vertical-align: top;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        Number of Copies
                    </td>

                    <td
                        style="padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        {{ isset($data['copies']) ? number_format($data['copies']) : '' }}
                    </td>
                </tr>

                {{-- <tr class="item">
                    <td style="padding: 5px;vertical-align: top;border-bottom: 1px solid #eee;">
                        Rate
                    </td>

                    <td
                        style="padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee;">
                        {{ isset($data['rate']) ? $data['rate'] : '' }}
                    </td>
                </tr> --}}

                <tr class="total">
                    <td
                        style="padding: 5px;vertical-align: top; text-align: center;font-weight: bold; text-align:left !important;padding-left: 10px !important;">
                        Total Estimated Expense
                    </td>

                    <td
                        style="padding: 5px;vertical-align: top;text-align: center;border-top: 2px solid #eee;font-weight: bold; text-align:left !important;padding-left: 10px !important;">
                        {{ isset($data['totalPrice']) ? number_format($data['totalPrice']) : '' }} Rs./-
                    </td>
                </tr>
            @elseif ($data['type'] === 'vehicle_media')
                <tr class="heading">
                    <td
                        style="padding: 5px;vertical-align: top;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold; text-align:left !important;padding-left: 10px !important;">
                        Selections
                    </td>

                    <td
                        style="padding: 5px;vertical-align: top;text-align: right;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold; text-align:left !important;padding-left: 10px !important;">
                        Details
                    </td>
                </tr>

                <tr class="item">
                    <td
                        style="padding: 5px;vertical-align: top;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        Route Selected
                    </td>

                    <td
                        style="padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        {{ isset($data['route']) ? $data['route'] : '' }}
                    </td>
                </tr>

                <tr class="item">
                    <td
                        style="padding: 5px;vertical-align: top;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        Paper
                    </td>

                    <td
                        style="padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        {{ isset($data['paper_type']) ? $data['paper_type'] : '' }}
                    </td>
                </tr>

                <tr class="item">
                    <td
                        style="padding: 5px;vertical-align: top;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        Duration
                    </td>

                    <td
                        style="padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        {{ isset($data['duration']) ? $data['duration'] : '' }}
                    </td>
                </tr>

                <tr class="item">
                    <td
                        style="padding: 5px;vertical-align: top;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        Number of Cars
                    </td>

                    <td
                        style="padding: 5px;vertical-align: top;text-align: right;border-bottom: 1px solid #eee; text-align:left !important;padding-left: 10px !important;">
                        {{ isset($data['copies']) ? $data['copies'] : '' }}
                    </td>
                </tr>

                <tr class="total">
                    <td
                        style="padding: 5px;vertical-align: top; font-weight: bold;text-align:left !important;padding-left: 10px !important;">
                        Estimated Expense
                    </td>

                    <td
                        style="padding: 5px; vertical-align: top;text-align: right;border-top: 2px solid #eee;font-weight: bold; text-align:left !important;padding-left: 10px !important;">
                        Total: {{ $data['totalPrice'] ? number_format($data['totalPrice']) : '' }} Rs./-
                    </td>
                </tr>
            @endif

        </table>
    </div>

    <br>
    <p><b>Note:</b> This is a computer generated quotation and is not valid proof for your order.</p>


    {{-- @dd($footerImage, $data['type']) --}}
</body>

</html>
