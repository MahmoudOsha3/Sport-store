<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تم الدفع بنجاح</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f3f4f6;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f3f4f6; padding: 20px 0;">
        <tr>
            <td align="center">
                <!-- Container -->
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; max-width: 600px; width: 100%;">

                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 30px; text-align: center;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center">
                                        <!-- Success Icon -->
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="width: 80px; height: 80px; background-color: #ffffff; border-radius: 50%; text-align: center; padding: 15px;">
                                                    <span style="font-size: 50px; color: #10b981;">✓</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 20px;">
                                        <h1 style="color: #ffffff; font-size: 28px; margin: 0 0 10px 0; font-weight: 600;">تم الدفع بنجاح! 🎉</h1>
                                        <p style="color: #ffffff; font-size: 16px; margin: 0; opacity: 0.95;">شكراً لك! تم استلام طلبك وسيتم معالجته قريباً</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px;">

                            <!-- Order Info Box -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f8fafc; border-radius: 12px; margin-bottom: 30px;">
                                <tr>
                                    <td style="padding: 25px;">

                                        <!-- Info Row 1 -->
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-bottom: 1px solid #e2e8f0; padding-bottom: 12px; margin-bottom: 12px;">
                                            <tr>
                                                <td style="color: #64748b; font-size: 14px;">رقم الطلب</td>
                                                <td align="left" style="color: #667eea; font-size: 18px; font-weight: 600;">#{{ $order->number_order }}</td>
                                            </tr>
                                        </table>

                                        <!-- Info Row 2 -->
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-bottom: 1px solid #e2e8f0; padding-bottom: 12px; margin-bottom: 12px;">
                                            <tr>
                                                <td style="color: #64748b; font-size: 14px;">تاريخ الطلب</td>
                                                <td align="left" style="color: #1e293b; font-size: 15px; font-weight: 600;">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                            </tr>
                                        </table>

                                        <!-- Info Row 3 -->
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-bottom: 1px solid #e2e8f0; padding-bottom: 12px; margin-bottom: 12px;">
                                            <tr>
                                                <td style="color: #64748b; font-size: 14px;">طريقة الدفع</td>
                                                <td align="left" style="color: #1e293b; font-size: 15px; font-weight: 600;">بطاقة ائتمان</td>
                                            </tr>
                                        </table>

                                        <!-- Info Row 4 -->
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="color: #64748b; font-size: 14px;">حالة الدفع</td>
                                                <td align="left" style="color: #10b981; font-size: 15px; font-weight: 600;">✓ مكتمل</td>
                                            </tr>
                                        </table>

                                    </td>
                                </tr>
                            </table>

                            <!-- Products Section -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 30px;">
                                <tr>
                                    <td>
                                        <h3 style="font-size: 18px; color: #1e293b; margin: 0 0 15px 0; font-weight: 600;">تفاصيل المنتجات</h3>
                                    </td>
                                </tr>

                                @foreach ($order->orderItems as $orderItem)
                                <!-- Product Item -->
                                <tr>
                                    <td style="padding-bottom: 10px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f8fafc; border-radius: 8px;">
                                            <tr>
                                                <td style="padding: 15px; width: 80px;">
                                                    <!-- Product Image -->
                                                    <img src="{{ config('app.url') }}/products/{{ $orderItem->product->image }}" alt="{{ $orderItem->product_name }}" style="width: 60px; height: 60px; border-radius: 8px; display: block; object-fit: cover;" />
                                                </td>
                                                <td style="padding: 15px;">
                                                    <h4 style="font-size: 15px; color: #1e293b; margin: 0 0 5px 0; font-weight: 600;">{{ $orderItem->product_name }}</h4>
                                                    <p style="font-size: 13px; color: #64748b; margin: 0;">الكمية: {{ $orderItem->quantity }}</p>
                                                </td>
                                                <td align="left" style="padding: 15px;">
                                                    <span style="font-weight: 600; color: #1e293b; font-size: 16px;">{{ number_format($orderItem->price * $orderItem->quantity, 2) }} ج.م</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                @endforeach
                            </table>

                            <!-- Total Section -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f1f5f9; border-radius: 12px; margin-bottom: 30px;">
                                <tr>
                                    <td style="padding: 20px;">

                                        <!-- Row 1 -->
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="padding: 10px 0;">
                                            <tr>
                                                <td style="font-size: 15px; color: #1e293b;">المجموع قبل الخصم</td>
                                                <td align="left" style="font-size: 15px; color: #1e293b;">{{ $order->couponUsage->total_order_before_discound ?? "لايوجد" }}</td>
                                            </tr>
                                        </table>

                                        <!-- Row 2 -->
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="padding: 10px 0;">
                                            <tr>
                                                <td style="font-size: 15px; color: #1e293b;">الشحن</td>
                                                <td align="left" style="font-size: 15px; color: #1e293b;">مجاني</td>
                                            </tr>
                                        </table>

                                        <!-- Row 3 -->
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="padding: 10px 0;">
                                            <tr>
                                                <td style="font-size: 15px; color: #1e293b;">كوبون خصم</td>
                                                <td align="left" style="font-size: 15px; color: #1e293b;">{{ $order->couponUsage->value_discound ?? "لايوجد" }}</td>
                                            </tr>
                                        </table>

                                        <!-- Final Total -->
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-top: 2px solid #cbd5e1; padding-top: 15px; margin-top: 10px;">
                                            <tr>
                                                <td style="font-size: 20px; font-weight: 700; color: #667eea;">الإجمالي</td>
                                                <td align="left" style="font-size: 20px; font-weight: 700; color: #667eea;">{{ number_format($order->total_price, 2) }} ج.م</td>
                                            </tr>
                                        </table>

                                    </td>
                                </tr>
                            </table>

                            <!-- Footer Note -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-top: 1px solid #e2e8f0; padding-top: 20px;">
                                <tr>
                                    <td align="center">
                                        <p style="color: #64748b; font-size: 14px; margin: 0 0 8px 0;">سيتم إرسال تأكيد الطلب إلى بريدك الإلكتروني</p>
                                        <p style="color: #64748b; font-size: 14px; margin: 0;">لأي استفسارات، تواصل معنا على: support@example.com</p>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
