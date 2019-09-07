<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a  class="simple-text logo-normal">
      {{ __('Exsystem') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('คู่มือการใช้งานเว็บไซต์') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        {{--<a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
          <p>{{ __('Laravel Examples') }}
            <b class="caret"></b>
          </p>
        </a>--}}
        {{--<div class="collapse show" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
          </ul>
        </div>--}}
      {{--</li>
      <li class="nav-item{{ $activePage == 'category' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('category.index') }}">
          <i class="material-icons">library_books</i>
            <p>{{ __('ข้อสอบแบบตัวเลือก') }}</p>
        </a>
      </li>--}}
      <li class="nav-item {{ ($activePage == 'category') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="false">
          <i class="material-icons">assignment</i>
          <p>{{ __('ข้อสอบแบบตัวเลือก') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'category')||($activePage == 'quiz')||($activePage == 'question') ? ' show' : '' }}" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'category' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('category.index') }}">
                <i class="material-icons">assignment</i>
                <span class="sidebar-normal">{{ __('กลุ่มวิชา') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'quiz' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('quiz.index') }}">
                <i class="material-icons">assignment</i>
                <span class="sidebar-normal"> {{ __('ข้อสอบ') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'question' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('question.index') }}">
                <i class="material-icons">assignment</i>
                <span class="sidebar-normal"> {{ __('คำถาม') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'category_q') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample2" aria-expanded="false">
          <i class="material-icons">content_paste</i>
          <p>{{ __('แบบสอบถาม') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'category_q')||($activePage == 'questionnaire')||($activePage == 'questionnaire_mng') ? ' show' : '' }}" id="laravelExample2">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'category_q' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('category_questionnaire.index') }}">
                <i class="material-icons">content_paste</i>
                <span class="sidebar-normal">{{ __('กลุ่มวิชาและกลุ่มแบบสอบถาม') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'questionnaire' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('questionnaire.index') }}">
                <i class="material-icons">content_paste</i>
                <span class="sidebar-normal"> {{ __('สร้างแบบสอบถาม') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'questionnaire_mng' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('phase_questionnaire.index') }}">
                <i class="material-icons">content_paste</i>
                <span class="sidebar-normal"> {{ __('จัดการแบบสอบถาม') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      {{--<li class="nav-item{{ $activePage == 'category_q' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('category_questionnaire.index') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('แบบสอบถาม') }}</p>
        </a>
      </li>--}}
      <li class="nav-item{{ $activePage == 'faculty' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('faculty.index') }}">
          <i class="material-icons">aspect_ratio</i>
          <p>{{ __('การจัดการคณะ') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'department' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('department.index') }}">
          <i class="material-icons">apps</i>
          <p>{{ __('การจัดการภาควิชา') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'room' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('room.index') }}">
          <i class="material-icons">featured_video</i>
          <p>{{ __('การจัดการห้องสอบ') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'quiz_q' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('quiz_questionnaire.index') }}">
          <i class="material-icons">card_travel</i>
          <p>{{ __('การจัดการข้อสอบ') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.index') }}">
          <i class="material-icons">account_box</i>
            <p>{{ __('การจัดการผู้ใช้งาน') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'report_room' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('report_room.index') }}">
          <i class="material-icons">dvr</i>
          <p>{{ __('ผลการทดสอบ') }}</p>
        </a>
      </li>

    </ul>
  </div>
</div>