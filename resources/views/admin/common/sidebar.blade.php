<!-- <div class="theme-setting-wrapper">
    <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
    <div id="theme-settings" class="settings-panel">
        <i class="settings-close mdi mdi-close"></i>
        <p class="settings-heading">SIDEBAR SKINS</p>
        <div class="sidebar-bg-options" id="sidebar-light-theme">
            <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
        </div>
        <div class="sidebar-bg-options selected" id="sidebar-dark-theme">
            <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
        </div>
        <p class="settings-heading mt-2">HEADER SKINS</p>
        <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
        </div>
    </div>
</div> -->
<!-- <div id="right-sidebar" class="settings-panel">
    <i class="settings-close mdi mdi-close"></i>
    <ul class="nav nav-tabs" id="setting-panel" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab"
                aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab"
                aria-controls="chats-section">CHATS</a>
        </li>
    </ul>
    <div class="tab-content" id="setting-content">
        <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel"
            aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
                <form class="form w-100">
                    <div class="form-group d-flex">
                        <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                        <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                    </div>
                </form>
            </div>
            <div class="list-wrapper px-3">
                <ul class="d-flex flex-column-reverse todo-list">
                    <li>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="checkbox" type="checkbox">
                                Team review meeting at 3.00 PM
                            </label>
                        </div>
                        <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                    <li>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="checkbox" type="checkbox">
                                Prepare for presentation
                            </label>
                        </div>
                        <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                  
                    <li class="completed">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="checkbox" type="checkbox" checked>
                                Schedule meeting for next week
                            </label>
                        </div>
                        <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                    <li class="completed">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="checkbox" type="checkbox" checked>
                                Project review
                            </label>
                        </div>
                        <i class="remove mdi mdi-close-circle-outline"></i>
                    </li>
                </ul>
            </div>
            <div class="events py-4 border-bottom px-3">
                <div class="wrapper d-flex mb-2">
                    <i class="mdi mdi-circle-outline text-primary mr-2"></i>
                    <span>Feb 11 2018</span>
                </div>
                <p class="mb-0 font-weight-thin text-gray">Creating component page</p>
                <p class="text-gray mb-0">build a js based app</p>
            </div>
            <div class="events pt-4 px-3">
                <div class="wrapper d-flex mb-2">
                    <i class="mdi mdi-circle-outline text-primary mr-2"></i>
                    <span>Feb 7 2018</span>
                </div>
                <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
        </div>
        <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
                <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See
                    All</small>
            </div>
            <ul class="chat-list">
                <li class="list active">
                    <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span
                            class="online"></span></div>
                    <div class="info">
                        <p>Thomas Douglas</p>
                        <p>Available</p>
                    </div>
                    <small class="text-muted my-auto">19 min</small>
                </li>
                <li class="list">
                    <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span
                            class="offline"></span></div>
                    <div class="info">
                        <div class="wrapper d-flex">
                            <p>Catherine</p>
                        </div>
                        <p>Away</p>
                    </div>
                    <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                    <small class="text-muted my-auto">23 min</small>
                </li>
                <li class="list">
                    <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span
                            class="online"></span></div>
                    <div class="info">
                        <p>Daniel Russell</p>
                        <p>Available</p>
                    </div>
                    <small class="text-muted my-auto">14 min</small>
                </li>
                <li class="list">
                    <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span
                            class="offline"></span></div>
                    <div class="info">
                        <p>James Richardson</p>
                        <p>Away</p>
                    </div>
                    <small class="text-muted my-auto">2 min</small>
                </li>
                <li class="list">
                    <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span
                            class="online"></span></div>
                    <div class="info">
                        <p>Madeline Kennedy</p>
                        <p>Available</p>
                    </div>
                    <small class="text-muted my-auto">5 min</small>
                </li>
                <li class="list">
                    <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span
                            class="online"></span></div>
                    <div class="info">
                        <p>Sarah Graves</p>
                        <p>Available</p>
                    </div>
                    <small class="text-muted my-auto">47 min</small>
                </li>
            </ul>
        </div>
    </div>
</div> -->



<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.dashboard')}}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui_master" aria-expanded="false"
                aria-controls="ui_master">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Master</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui_master">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin.params')}}">Params</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin.location')}}">Location</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin.rules')}}">Rules</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin.document')}}">Document</a></li>
                </ul>
            </div>
        </li> 

        <!-- <li class="nav-item">
            <a class="nav-link" href="{{route('admin.params')}}">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Params</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.location')}}">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Location</span>
            </a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.roomType')}}">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Room Type</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.rooms')}}">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Room</span>
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="{{route('admin.rules')}}">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Rules</span>
            </a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.cancelPlan')}}">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Cancel Plan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.cautionMoney')}}">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Caution Money</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.roomCharge')}}">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Room Charge</span>
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="{{route('admin.document')}}">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Document</span>
            </a>
        </li> -->

        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.roomRent')}}">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Room Rent</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.hallRent')}}">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Hall Rent</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.canteenMenu')}}">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Canteen Menu</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui_bulk" aria-expanded="false"
                aria-controls="ui_bulk">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Bulk Booking</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui_bulk">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin.bulkbook')}}">BOOKING</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin.bulkManage')}}">Manage Bulk</a></li>
              
                </ul>
            </div>
        </li> 
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#consilidate_bulk" aria-expanded="false"
                aria-controls="consilidate_bulk">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Consolidate</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="consilidate_bulk">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin.consolidate_list')}}">Consolidate Bill List</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin.consolidatebills')}}">Consolidate Bill Entry</a></li>
                </ul>
            </div>
        </li> 
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui_advanced" aria-expanded="false"
                aria-controls="ui_advanced">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Booking</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui_advanced">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin.manageBooking')}}">Manage Room</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin.manageHallBooking')}}">Manage Hall</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin.booking')}}">Room Booking</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin.hallBooking')}}">Hall Booking</a></li>
                </ul>
            </div>
        </li> 
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#payment" aria-expanded="false"
                aria-controls="payment">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Payment status & Final bill</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="payment">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin.roompaymentStatus')}}">Room</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin.hallpaymentStatus')}}">Hall</a></li>
                </ul>
            </div>
        </li> 
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#report" aria-expanded="false"
                aria-controls="report">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Report</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="report">
                <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.bookinglist')}}">Booking Summary</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin.paymentRoom')}}">Payment received for room</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('admin.onlinepayment')}}">Online Payment</a></li>
                </ul>
            </div>
        </li> 
        <!-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-advanced" aria-expanded="false"
                aria-controls="ui-advanced">
                <i class="mdi mdi-layers menu-icon"></i>
                <span class="menu-title">Advanced UI</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-advanced">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dragula.html">Dragula</a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/clipboard.html">Clipboard</a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/context-menu.html">Context
                            menu</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/slider.html">Sliders</a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/carousel.html">Carousel</a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/colcade.html">Colcade</a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/loaders.html">Loaders</a></li>
                </ul>
            </div>
        </li> -->
    </ul>
</nav>