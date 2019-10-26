@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('หน้าแรก')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header card-header-rose">
          <h4 class="card-title text-center">ยินดีต้อนรับ <br> เข้าสู่ระบบบริหารจัดการข้อสอบแบบตัวเลือกและกระบวนการสอบ</h4>
        </div>
        <div class="card-body"> ติดต่อ มจพ. กรุงเทพฯ <br>
            มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ <br>
            1518 ถนนประชาราษฎร์ 1 แขวงวงศ์สว่าง เขตบางซื่อ <br>
            กรุงเทพฯ 10800 <br>
            โทรศัพท์ : +66 2 555-2000 <br>
            แฟกซ์ : +66 2 587-4350 <br>
            อีเมล : contact@op.kmutnb.ac.th   </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
  </script>
@endpush