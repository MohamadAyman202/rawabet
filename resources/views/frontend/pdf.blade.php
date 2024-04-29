<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('frontend/assets/bootstrap/dist/css/bootstrap.min.css') }}">
    <style>
        table,
        tr,
        td,
        th {
            border: 1px solid black;
        }
    </style>
</head>

<body style="">
    <section class="py-5">
        <div class="container">
            <div class="">
                <h1 class="text-center fw-bolder">بسم الله الرحمن الرحيم</h1>
            </div>
            <div class="pt-2">
                <p class="text-end fs-3 fw-bold ">السلام عليكم ورحمة الله وبركاته</p>
            </div>
            <div class="pb-2">
                <p class="text-center fs-4">يقوم الباحثون بإجراء دراسة بعنوان " واقع الابداع البحثي لدي خريجين قسم
                    الإدارة بالمعهد العالي للعلوم الادارية المتقدمة والحاسبات
                    وعليه أرجو منكم التكرم بالإجابة على بنود هذه الاستبانة بكل دقة وموضوعية. علمًا بأن البيانات التي سوف
                    يتم الحصول عليها ستعامل بسرية تامة، ولن تُستخدم إلا لأغراض البحث العلمي فقط.</p>
            </div>
            <div>
                <p class="text-center fs-4 fw-bold">ولكم جزيل الشكر</p>
            </div>
            @php
                $firstTrue = 0;
                $endTrue = 0;
                $one_1 = 0;
                $one_12 = 0;
                $one_13 = 0;
                $one_14 = 0;
                $one_15 = 0;
                $one_16 = 0;
                $count = 1;
            @endphp
            @for ($i = 0; $i <= 160; $i++)
                <div class="d-none">
                    @if ($i % 2 == 0 && $i > 10)
                        {{ $firstTrue = '✔️' }}
                        {{ $endTrue = '' }}
                        {{ $one_1 = '' }}
                        {{ $one_12 = '' }}
                    @elseif ($i % 2 == 0 && $i > 15)
                        {{ $one_1 = '✔️' }}
                        {{ $one_12 = '' }}
                    @else
                        {{ $firstTrue = '' }}
                        {{ $endTrue = '✔️' }}
                        {{ $one_13 = '' }}
                        {{ $one_1 = '' }}
                        {{ $one_12 = '' }}
                    @endif
                </div>

                <div>
                    <h3 class="text-center py-5">الاستبانة</h3>
                </div>
                <div>
                    <h2 class="text-end">القسم الأول: الخصائص الشخصية <br /> Section One: Personal Characteristics</h2>
                </div>
                <div dir="rtl" class="py-3">

                    <ol>
                        <li>
                            الجنس Gender
                        </li>
                    </ol>
                    <ul>
                        <li> ذكر Male {{ $i <= 88 ? '✔️' : '' }}</li>
                        <li> أنثى Female {{ $i > 88 ? '✔️' : '' }}</li>
                    </ul>
                </div>

                <div>
                    <p class="text-end p-3 fw-400 fs-4">القسم الثاني: يهدف إلى قياس مستوى واقع الابداع البحثي لدي خريجين
                        قسم
                        الإدارة بالمعهد
                        العالي للعلوم الادارية المتقدمة والحاسبات. من خلال قياس الآتي: القدرة على الربط والتحليل،
                        الطلاقة
                        البحثية، مواصلة الاتجاه نحو الهدف، المرونة البحثية، الحساسية للمشكلات، الأصالة البحثية،
                        المخاطرة،
                        الخروج عن المألوف</p>
                </div>
                <div>
                    <p class="fs-3 text-end">أرجو التكرم بوضع علامة أمام الخيار الذي يعبر عن مدى مستوى تحقق العبارة
                        لديك.
                    </p>
                </div>

                <div>

                    <div class="table-responsive" dir="rtl">
                        <table id="example" class="table table-striped" style="width:100%">
                            <tr>
                                <th>م</th>
                                <th>العبارة</th>
                                <th>ضعيف جدًا</th>
                                <th>ضعيف</th>
                                <th>متوسط</th>
                                <th>كبير</th>
                                <th>كبير جدًا</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>القدرة على تحليل مهام العمل أو تفاصيل المشكلة قبل البدء في التنفيذ.</td>
                                    <td>{{ $firstTrue }}</td>
                                    <td>{{ $endTrue }}</td>
                                    <td>{{ $one_1 }}</td>
                                    <td>{{ $one_12 }}</td>
                                    <td>{{ $one_13 }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>القدرة على الربط بين الخبرات السابقة وما يتم اكتسابه من خبرات عند حل المشكلات.
                                    </td>
                                    <td>{{ $endTrue }}</td>
                                    <td>{{ $one_12 }}</td>
                                    <td>{{ $one_1 }}</td>
                                    <td>{{ $one_13 }}</td>
                                    <td>{{ $firstTrue }}</td>
                                </tr>
                                <th colspan="10" class="text-center">قياس القدرة على التحليل والربط</th>
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>القدرة على طرح أفكار متعددة بألفاظ وجمل مختلفة.</td>
                                    <td>{{ $one_12 }}</td>
                                    <td>{{ $endTrue }}</td>
                                    <td>{{ $one_1 }}</td>
                                    <td>{{ $firstTrue }}</td>
                                    <td>{{ $one_13 }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>القدرة على الدفاع عن الأفكار بالحجة والبراهين.</td>
                                    <td>{{ $endTrue }}</td>
                                    <td>{{ $one_12 }}</td>
                                    <td>{{ $one_13 }}</td>
                                    <td>{{ $firstTrue }}</td>
                                    <td>{{ $one_1 }}</td>
                                </tr>

                                <th colspan="10" class="text-center">قياس الطلاقة البحثية</th>

                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>القدرة على مواجهة المشكلات التي تعيق تحقيق الأهداف والعمل بقوة من أجل حلها.</td>
                                    <td>{{ $one_12 }}</td>
                                    <td>{{ $endTrue }}</td>
                                    <td>{{ $firstTrue }}</td>
                                    <td>{{ $one_13 }}</td>
                                    <td>{{ $one_1 }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>الشعور بالحماس العالي والانتباه طوال فترة السير نحو الهدف.</td>
                                    <td>{{ $one_13 }}</td>
                                    <td>{{ $one_12 }}</td>
                                    <td>{{ $endTrue }}</td>
                                    <td>{{ $one_1 }}</td>
                                    <td>{{ $firstTrue }}</td>
                                </tr>

                                <th colspan="10" class="text-center">قياس مواصلة الاتجاه نحو الهدف</th>

                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>القدرة على معالجة المشكلات من زوايا متعددة.</td>
                                    <td>{{ $endTrue }}</td>
                                    <td>{{ $one_12 }}</td>
                                    <td>{{ $one_13 }}</td>
                                    <td>{{ $firstTrue }}</td>
                                    <td>{{ $one_1 }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>التنوع في أدوات جمع البيانات بما يواكب التغيرات الحديثة في مجال البحث العلمي.
                                    </td>
                                    <td>{{ $one_12 }}</td>
                                    <td>{{ $endTrue }}</td>
                                    <td>{{ $one_1 }}</td>
                                    <td>{{ $firstTrue }}</td>
                                    <td>{{ $one_13 }}</td>
                                </tr>

                                <th colspan="10" class="text-center">قياس المرونة البحثية</th>

                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>القدرة على التنبؤ بالمشكلات قبل وقوعها.</td>
                                    <td>{{ $endTrue }}</td>
                                    <td>{{ $firstTrue }}</td>
                                    <td>{{ $one_12 }}</td>
                                    <td>{{ $one_13 }}</td>
                                    <td>{{ $one_1 }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>القدرة على تحديد جوانب القصور والضعف في الأفكار الشائعة.</td>
                                    <td>{{ $one_12 }}</td>
                                    <td>{{ $one_13 }}</td>
                                    <td>{{ $endTrue }}</td>
                                    <td>{{ $firstTrue }}</td>
                                    <td>{{ $one_1 }}</td>
                                </tr>

                                <th colspan="10" class="text-center">قياس الحساسية للمشكلات</th>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive" dir="rtl">
                        <table id="example" class="table table-striped mt-5" style="width:100%">
                            <tr>
                                <th>م</th>
                                <th>العبارة</th>
                                <th>ضعيف جدًا</th>
                                <th>ضعيف</th>
                                <th>متوسط</th>
                                <th>كبير</th>
                                <th>كبير جدًا</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>الحرص على طرح أفكار مستقلة وجديدة ونادرة وعدم التبعية والتقليد لأفكار مطروحة
                                        مسبقًا
                                        من الآخرين.</td>
                                    <td>{{ $one_12 }}</td>
                                    <td>{{ $endTrue }}</td>
                                    <td>{{ $one_13 }}</td>
                                    <td>{{ $one_1 }}</td>
                                    <td>{{ $firstTrue }}</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>القدرة على طرح أفكار عميقة بعيدة عن السطحية.
                                    </td>
                                    <td>{{ $firstTrue }}</td>
                                    <td>{{ $one_12 }}</td>
                                    <td>{{ $endTrue }}</td>
                                    <td>{{ $one_13 }}</td>
                                    <td>{{ $one_1 }}</td>
                                </tr>
                                <th colspan="10" class="text-center">قياس الأصالة البحثية</th>
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>القدرة على تبني أفكار جديدة حتى وإن كان في تطبيقها بعض المعوقات.</td>
                                    <td>{{ $endTrue }}</td>
                                    <td>{{ $one_12 }}</td>
                                    <td>{{ $one_13 }}</td>
                                    <td>{{ $one_1 }}</td>
                                    <td>{{ $firstTrue }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>القدرة على تقبل انتقادات الآخرين بصدر رحب.</td>
                                    <td>{{ $one_12 }}</td>
                                    <td>{{ $endTrue }}</td>
                                    <td>{{ $one_13 }}</td>
                                    <td>{{ $firstTrue }}</td>
                                    <td>{{ $one_1 }}</td>
                                </tr>

                                <th colspan="10" class="text-center">قياس المخاطرة</th>

                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>القدرة على استخدام أسلوب متميز عن أساليب الآخرين.</td>
                                    <td>{{ $one_12 }}</td>
                                    <td>{{ $one_13 }}</td>
                                    <td>{{ $endTrue }}</td>
                                    <td>{{ $firstTrue }}</td>
                                    <td>{{ $one_1 }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>الحرص على عرض نتائج البحث بطرق مبتكرة.</td>
                                    <td>{{ $endTrue }}</td>
                                    <td>{{ $one_12 }}</td>
                                    <td>{{ $one_13 }}</td>
                                    <td>{{ $firstTrue }}</td>
                                    <td>{{ $one_1 }}</td>
                                </tr>

                                <th colspan="10" class="text-center">قياس الخروج عن المألوف</th>
                            </tbody>
                        </table>
                    </div>

                    <p class="text-end fs-4 fw-500 py-3">القسم الثاني: يتعلق بالمعوقات التي تحد من ممارسة واقع الابداع
                        البحثي لدي
                        خريجين قسم الإدارة بالمعهد
                        العالي للعلوم الادارية المتقدمة والحاسبات.
                        المحور الأول: معوقات الإبداع البحثي المتعلقة بالباحث</p>

                    <div class="table-responsive" dir="rtl">
                        <table id="example" class="table table-striped" style="width:100%">
                            <tr>
                                <th>م</th>
                                <th>العبارة</th>
                                <th>ضعيف جدًا</th>
                                <th>ضعيف</th>
                                <th>متوسط</th>
                                <th>كبير</th>
                                <th>كبير جدًا</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>لا أشعر بدافعية كبيرة نحو استكشاف الأفكار البحثية الجديدة.</td>
                                    <td>{{ $one_12 }}</td>
                                    <td>{{ $endTrue }}</td>
                                    <td>{{ $one_13 }}</td>
                                    <td>{{ $firstTrue }}</td>
                                    <td>{{ $one_1 }}</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>لا أحرص على متابعة الجديد في الأبحاث ذات العلاقة بمجال التخصص.
                                    </td>
                                    <td>{{ $one_12 }}</td>
                                    <td>{{ $endTrue }}</td>
                                    <td>{{ $one_13 }}</td>
                                    <td>{{ $one_1 }}</td>
                                    <td>{{ $firstTrue }}</td>
                                </tr>
                                <th colspan="10" class="text-center">معوقات الإبداع البحثي المتعلقة بالباحث</th>
                            </tbody>
                        </table>
                    </div>

                    <p class="text-end fs-4 fw-500 py-3">المحور الثاني: معوقات الإبداع البحثي المتعلقة بالبيئة البحثية.
                    </p>

                    <div class="table-responsive" dir="rtl">
                        <table id="example" class="table table-striped" style="width:100%">
                            <tr>
                                <th>م</th>
                                <th>العبارة</th>
                                <th>ضعيف جدًا</th>
                                <th>ضعيف</th>
                                <th>متوسط</th>
                                <th>كبير</th>
                                <th>كبير جدًا</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>إن التدريس بالكلية يعتمد على الطرق التقليدية، حيث التركيز على التلقين أكثر من
                                        التفكير الإبداعي.</td>
                                    <td>{{ $endTrue }}</td>
                                    <td>{{ $one_12 }}</td>
                                    <td>{{ $one_13 }}</td>
                                    <td>{{ $one_1 }}</td>
                                    <td>{{ $firstTrue }}</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>عدم إعطاء طلاب وطالبات الدراسات العليا. الحرية الأكاديمية اللازمة لتوليد الأفكار
                                        البحثية المتميزة.
                                    </td>
                                    <td>{{ $firstTrue }}</td>
                                    <td>{{ $one_12 }}</td>
                                    <td>{{ $one_13 }}</td>
                                    <td>{{ $endTrue }}</td>
                                    <td>{{ $one_1 }}</td>
                                </tr>
                                <th colspan="10" class="text-center">معوقات الإبداع البحثي المتعلقة بالبيئة البحثية
                                </th>
                            </tbody>
                        </table>
                    </div>
                    @if ($i == 160)
                        <div class="d-flex justify-content-end align-items-center pt-5">

                            <div style="width:40%;">
                                <p class="text-end">الرجاء التكرم بإبداء أي ملاحظات أخرى لها علاقة بموضوع الاستبانة.

                                    <br>
                                    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                                    <br>
                                    Other notes, please specify
                                    <br>
                                    -------------------------------------------------------------------------------------------------------------------------------------------------------
                                </p>
                            </div>
                        </div>
                    @endif
            @endfor

        </div>
    </section>

    <script src="{{ URL::asset('frontend/assets/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>



