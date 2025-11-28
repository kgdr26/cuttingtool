<div class="navbar">
    <div class="row w-100">
        <div class="col-6 d-flex align-items-center justify-content-start">
            <i class="icon-header-menu-{{$icontitle}}"></i>
            <p class="title-navbar">{{$title}}</p>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
            <p class="title-navbar no-bold" id="date_show"></p>
            <div class="card-profile-img">
                <div class="d-flex align-items-center justify-content-end">
                    <div class="flex-grow-1 me-3">
                        <div class="d-flex justify-content-end">
                            <span class="text-name-profile d-block">{{strtoupper(Auth::user()->name)}}</span>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <small class="text-role-profile ms-auto">
                                @if(Auth::user()->role == 'admin')
                                    SUPERADMIN
                                @elseif(Auth::user()->role == 'eng')
                                    ENGINEERING
                                @elseif(Auth::user()->role == 'opr')
                                    OPERATOR
                                @else
                                    -
                                @endif
                            </small>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="dropdown dropstart">
                            <a class="dropdown-toggle profile" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{asset('assets/images/default.jpg')}}" alt="">
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item tex-item-drop" href="">
                                        <i class="bi bi-person-circle"></i> Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item tex-item-drop" href="{{route('logout')}}">
                                        <i class="bi bi-box-arrow-in-left"></i> Log Out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>