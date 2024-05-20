@extends('layouts.admin')

@section('title')
    Quản lý chấm công
@endsection

@section('style-plugins')
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('src/plugins/css/light/table/datatable/custom_dt_miscellaneous.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('src/plugins/css/dark/table/datatable/custom_dt_miscellaneous.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/custom_dt_custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/table/datatable/custom_dt_custom.css') }}">
    <link rel="stylesheet" href="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.css') }}">

    <link href="{{ asset('src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/plugins/src/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/light/fullcalendar/custom-fullcalendar.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/fullcalendar/custom-fullcalendar.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('script-plugins')
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- datatable --}}
    <script src="{{ asset('src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/jszip.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/buttons.print.min.js') }}"></script>
    {{-- sweatalert2 --}}
    <script src="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>

    <script src="{{ asset('src/plugins/src/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/uuid/uuid4.min.js') }}"></script>

    @include('includes.toast')
@endsection

@section('content')
    <div class="row layout-top-spacing">
        <div id="users-box" class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Quản lý chấm công</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="layout-top-spacing ps-3 pe-3 col-12">
                        <div class="row d-flex align-items-end">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="start-date">Tháng chấm công</label>
                                    <select name="" id="timekeeping-month" class="form-select">
                                        <option value="{{ getNowFormat('m') }}">Lựa chọn</option>
                                        @for ($i = 1; $i < 13; $i++)
                                        <option value="{{ $i}}">Tháng {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="end-date">Năm chấm công</label>
                                    <select name="" id="timekeeping-year" class="form-select">
                                        <option value="{{ getNowFormat('Y') }}">Lựa chọn</option>
                                        @for ($i = 2020; $i < 2025; $i++)
                                        <option value="{{ $i}}">Năm {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table id="datatable" class="table style-3 dt-table-hover" style="width:100%">
                                <thead>
                                    <tr role="row">
                                        <th>#</th>
                                        <th>Thông tin</th>
                                        <th>T/t chấm công</th>
                                        <th>Người chấm công</th>
                                        <th>Số ngày làm</th>
                                        <th>Số ngày nghỉ T7, CN</th>
                                        <th>Số ngày nghỉ</th>
                                        <th>Số giờ tăng ca</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row layout-top-spacing layout-spacing" id="cancel-row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="calendar-container">
                <div class="calendar"></div>

                <button
                    class="btn btn-primary _effect--ripple waves-effect waves-light mt-4"
                    id="btn-complete"
                >
                    Hoàn tất
                </button>
            </div>
        </div>
    </div>

    <form action="">
        <div class="modal fade" id="timekeepingModal"tabindex="-1" aria-labelledby="timekeepingModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="timekeepingModalLabel">Chấm công</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" id="form-working-status">
                                    <label class="form-label">Trạng thái làm việc</label>
                                    <select id="working-status" class="form-select">
                                        <option value="" data-show-ot="{{ false }}">Lựa chọn</option>
                                        @foreach ($workingStatuses as $item)
                                        <option
                                            value="{{ $item['case'] }}"
                                            data-show-ot="{{ $item['isShowOT'] ?? 0 }}"
                                        >
                                            {{ $item['description'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 d-none" id="form-work-type">
                                <div class="form-group mt-4">
                                    <label class="form-label">Loại công (Nếu không chọn mặc định là ngày thường)</label>
                                    <select id="work-type" class="form-select">
                                        <option value="">Lựa chọn</option>
                                        @foreach ($workTypes as $item)
                                        <option value="{{ $item['case'] }}">{{ $item['description'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mt-4 d-none" id="form-ot-time">
                                <label class="form-label">Số giờ tăng ca (Nếu không tăng ca thì để trống)</label>
                                <input type="number" min="0" id="ot-time" class="form-control" placeholder="Số giờ tăng ca">
                            </div>

                            <input id="event-start-date" type="hidden">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Thoát</button>
                        <button class="btn btn-primary btn-save-event">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <input type="hidden" id="user-id">
    <input type="hidden" id="user-name">
@endsection

@section('script')
    <script>
        let drawDT = 0;

        const c1 = $('#datatable').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sEmptyTable": "Chưa có dữ liệu",
                "sInfo": "Hiển thị trang _PAGE_ trong _PAGES_",
                "sInfoEmpty": "Hiển thị trang _PAGES_ trong _PAGES_s",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Tìm kiếm...",
                "sLengthMenu": "Số lượng :  _MENU_",
                "sInfoFiltered": "(Lọc từ tổng số _MAX_ bản ghi)",
                "sZeroRecords": "Không có bản ghi nào trùng khớp",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": "{{ route('admin.timekeeping.index') }}",
                "data": function(d) {
                    let searchParams = new URLSearchParams(window.location.search);
                    drawDT = d.draw;
                    d.limit = d.length;
                    d.page = d.start / d.length + 1;
                    d.month = $('#timekeeping-month').val();
                    d.year = $('#timekeeping-year').val();
                },
                "dataSrc": function(res) {
                    res.draw = drawDT;
                    res.recordsTotal = res.meta ? res.meta.total : res.total;
                    res.recordsFiltered = res.meta ? res.meta.total : res.total;
                    return res.data;
                }
            },
            "columns": [{
                    "data": "id",
                    "class": "text-center",
                    "render": function(data, type, full, meta) {
                        return meta.row + 1;
                    },
                },
                {
                    "data": "name",
                    "render": function(data, type, full, meta) {
                        return `
                            <div class="d-flex">
                                <p class="text-start pe-2" style="width:60px;">Tên:</p>
                                <p>${data}</p>
                            </div>
                            <div class="d-flex">
                                <p class="text-start pe-2" style="width:60px;">Email:</p>
                                <p>${full.email}</p>
                            </div>
                        `;
                    },
                },
                {
                    "data": "timekeeping",
                    "class": "text-center",
                    "render": function(data, type, full, meta) {
                        return data ?
                        '<span class="badge badge-primary">Đã chấm công</span>'
                        :
                        '<span class="badge badge-danger">Chưa chấm công</span>';
                    },
                },
                {
                    "data": "timekeeping",
                    "class": "text-center",
                    "render": function(data, type, full, meta) {
                        return data ?
                        data.approved_by.name
                        :
                        'N/A';
                    },
                },
                {
                    "data": "timekeepingData",
                    "class": "text-center",
                    "render": function(data, type, full, meta) {
                        return data ?
                        `
                        <div class="d-flex justify-content-between">
                            <p class="pe-2">Ngày thường:</p>
                            <p>${data.normal_work_count}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="pe-2">Ngày nghỉ:</p>
                            <p>${data.weekend_work_count}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="pe-2">Ngày lễ:</p>
                            <p>${data.holiday_work_count}</p>
                        </div>
                        `
                        :
                        'N/A';
                    },
                },
                {
                    "data": "timekeepingData",
                    "class": "text-center",
                    "render": function(data, type, full, meta) {
                        return data ?
                        data.weekend_count
                        :
                        'N/A';
                    },
                },
                {
                    "data": "timekeepingData",
                    "class": "text-center",
                    "render": function(data, type, full, meta) {
                        return data ?
                        data.dayoff_count
                        :
                        'N/A';
                    },
                },
                {
                    "data": "timekeepingData",
                    "class": "text-center",
                    "render": function(data, type, full, meta) {
                        return data ?
                        `
                        <div class="d-flex justify-content-between">
                            <p class="pe-2">Ngày thường:</p>
                            <p>${data.normal_ot_total}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="pe-2">Ngày nghỉ:</p>
                            <p>${data.weekend_ot_total}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="pe-2">Ngày lễ:</p>
                            <p>${data.holiday_ot_total}</p>
                        </div>
                        `
                        :
                        'N/A';
                    },
                },
                {
                    "data": "id",
                    "class": "text-center",
                    "render": function(data, type, full) {
                        let urlEdit = `{{ route('admin.user.edit', ':id') }}`.replace(':id', data);
                        let urlDestroy = `{{ route('admin.user.destroy', ':id') }}`.replace(':id',
                            data);

                        return `
                            <div class="action-btns">
                                <button
                                    class="btn btn-primary _effect--ripple waves-effect waves-light btn-sm btn-timekeeping"
                                    data-user-id="${data}"
                                    data-user-name="${full.name}"
                                >
                                    Chấm công
                                </button>
                            </div>
                        `;
                    }
                },
            ]
        });

        multiCheck(c1);

        $(document).on('keyup', '.search-bar .search-form-control', function() {
            processChange();
        });

        function debounce(func, timeout = 500) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    func.apply(this, args);
                }, timeout);
            };
        }

        function searchDT() {
            c1.search($('.search-bar .search-form-control').val()).draw();
        }

        const processChange = debounce(() => searchDT());

        $('.search-bar .search-close').on('click', function(e) {
            c1.search('').draw();
        });

        $('#datatable').on('draw.dt', function () {
            if($('#user-id').val() == '' && $('#user-name').val() == '') {
                let btn = document.querySelector('.btn-timekeeping');
                $('#user-id').val(btn.dataset.userId);
                $('#user-name').val(btn.dataset.userName);
            }

            let calendarEl = document.querySelector('.calendar');

            let calendarHeaderToolbar = {
                left: '',
                center: 'title',
                right: ''
            }

            let calendarEventsList = [];

            let calendarSelect = function (info) {
                $('#form-work-type').addClass('d-none');
                $('#form-ot-time').addClass('d-none');

                $('#working-status').val('');
                $('#work-type').val('');
                $('#ot-time').val('');

                let allEvents = calendar.getEvents();

                let eventsForDate = allEvents.filter(function (event) {
                    return event.startStr === info.startStr;
                });

                eventsForDate.forEach(event => {
                    if(event._def.extendedProps.type == 'working-status') {
                        $('#working-status').val(event._def.extendedProps.data);
                    }
                    else if(event._def.extendedProps.type == 'work-type') {
                        $('#work-type').val(event._def.extendedProps.data);
                        $('#form-work-type').removeClass('d-none');
                        $('#form-ot-time').removeClass('d-none');
                    }
                    else if(event._def.extendedProps.type == 'ot-time') {
                        $('#ot-time').val(event._def.extendedProps.data);
                        $('#form-work-type').removeClass('d-none');
                        $('#form-ot-time').removeClass('d-none');
                    }
                });

                myModal.show()
                getModalStartDateEl.value = info.startStr;
            }

            let calendar = new FullCalendar.Calendar(calendarEl, {
                selectable: true,
                height: 700,
                headerToolbar: calendarHeaderToolbar,
                titleFormat: function (info) {
                    return `${$('#user-name').val()} ${info.date.month + 1}/${info.date.year}`;
                },
                events: calendarEventsList,
                select: calendarSelect,
                unselect: function () {
                    console.log('unselected')
                },
                eventClassNames: function ({ event: calendarEvent }) {
                    const getColorValue = calendarEvent._def.extendedProps.calendarType;
                    return [
                        'event-fc-color fc-bg-' + getColorValue,
                    ];
                },
            });

            let getModalStartDateEl = document.querySelector('#event-start-date');
            let getModalSaveBtnEl = document.querySelector('.btn-save-event');

            document.querySelector('#btn-complete').onclick = () => {
                let timekeepingMonth = $('#timekeeping-month').val();
                let timekeepingYear = $('#timekeeping-year').val();

                let allEvents = calendar.getEvents();

                let result = allEvents.map(event => {
                    return {
                        startStr: event.startStr,
                        type: event._def.extendedProps.type,
                        data: event._def.extendedProps.data,
                    };
                });

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal
                            .stopTimer)
                        toast.addEventListener('mouseleave', Swal
                            .resumeTimer)
                    }
                });

                let url = `{{ route('admin.timekeeping.update', ':id') }}`.replace(':id', $('#user-id').val());

                $.ajax({
                    type: 'PUT',
                    url,
                    data: {
                        _token: @json(@csrf_token()),
                        month: timekeepingMonth,
                        year: timekeepingYear,
                        data: result ? result : [],
                    },
                    success: function(response) {
                        if (response) {

                            let icon = response.icon ? response.icon : 'success';
                            let title = response.title ? response.title : 'Chấm công thành công!';

                            Toast.fire({
                                icon,
                                title
                            });

                            processChange();
                        }
                    },
                    error: function(response) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Chấm công không thành công!'
                        });
                    }
                });

            };

            let timekeepingMonth = document.querySelector('#timekeeping-month');
            let timekeepingYear = document.querySelector('#timekeeping-year');

            const customMonth = (month) => {
                if(month < 10){
                    return `0${month}`;
                }
                return month;
            }

            const reloadCalendar = async () => {
                let month = parseInt(timekeepingMonth.value);
                let year = parseInt(timekeepingYear.value);

                let newValidRange = {
                    start: `${year}-${customMonth(month)}-01`,
                    end: `${year}-${customMonth(month + 1)}-01`,
                };

                calendar.setOption('validRange', newValidRange);

                await calendar.refetchEvents();


                let allEvents = calendar.getEvents();

                let eventsForDate = allEvents.filter(function (event) {
                    return event.start.getFullYear() === year &&
                        event.start.getMonth() + 1 === month;
                }).forEach(element => {
                    let event = calendar.getEventById(element.id);
                    event.remove();
                });

                let url = `{{ route('admin.timekeeping.data', ':id') }}`.replace(':id', $('#user-id').val());

                $.ajax({
                    type: 'POST',
                    url,
                    data: {
                        _token: @json(@csrf_token()),
                        month,
                        year,
                    },
                    success: function(response) {
                        if (response) {
                            response.forEach(item =>{
                                let workingStatus = item.working_status;
                                let workType = item.work_type;
                                let otTime = item.ot_time;
                                let date = item.date;

                                if(workingStatus !== '') {
                                    $('#working-status').val(workingStatus);

                                    let title = $('#working-status option:selected').html();

                                    calendar.addEvent({
                                        id: uuidv4(),
                                        title,
                                        start: date,
                                        allDay: true,
                                        extendedProps: {
                                            calendarType: 'primary',
                                            type: 'working-status',
                                            data: workingStatus,
                                        }
                                    });

                                    if(workType != null) {
                                        $('#work-type').val(workType);

                                        let title = $('#work-type option:selected').html();

                                        calendar.addEvent({
                                            id: uuidv4(),
                                            title,
                                            start: date,
                                            allDay: true,
                                            extendedProps: {
                                                calendarType: 'success',
                                                type: 'work-type',
                                                data: workType,
                                            }
                                        });
                                    }

                                    if(otTime != 0) {
                                        let title = `Tăng ca ${otTime}h`

                                        calendar.addEvent({
                                            id: uuidv4(),
                                            title,
                                            start: date,
                                            allDay: true,
                                            extendedProps: {
                                                calendarType: 'warning',
                                                type: 'ot-time',
                                                data: otTime,
                                            }
                                        });
                                    }
                                }
                            });
                        }
                    },
                    error: function(response) {
                    }
                });
            }

            timekeepingMonth.onchange = async () => {
                processChange();
                await reloadCalendar();
            }

            timekeepingYear.onchange = async () => {
                processChange();
                await reloadCalendar();
            }

            reloadCalendar();

            getModalSaveBtnEl.addEventListener('click', function (e) {
                e.preventDefault();

                let setModalStartDateValue = getModalStartDateEl.value;

                let allEvents = calendar.getEvents();

                let eventsForDate = allEvents.filter(function (event) {
                    return event.startStr === setModalStartDateValue;
                }).forEach(element => {
                    let event = calendar.getEventById(element.id);
                    event.remove();
                });

                let workingStatus = $('#working-status').val();
                let workType = $('#work-type').val();
                let otTime = $('#ot-time').val();

                if(workingStatus !== '') {
                    let title = $('#working-status option:selected').html();

                    calendar.addEvent({
                        id: uuidv4(),
                        title,
                        start: setModalStartDateValue,
                        allDay: true,
                        extendedProps: {
                            calendarType: 'primary',
                            type: 'working-status',
                            data: workingStatus,
                        }
                    });

                    if(workType !== '') {
                        let title = $('#work-type option:selected').html();

                        calendar.addEvent({
                            id: uuidv4(),
                            title,
                            start: setModalStartDateValue,
                            allDay: true,
                            extendedProps: {
                                calendarType: 'success',
                                type: 'work-type',
                                data: workType,
                            }
                        });
                    }

                    if(otTime !== '') {
                        let title = `Tăng ca ${otTime}h`

                        calendar.addEvent({
                            id: uuidv4(),
                            title,
                            start: setModalStartDateValue,
                            allDay: true,
                            extendedProps: {
                                calendarType: 'warning',
                                type: 'ot-time',
                                data: otTime,
                            }
                        });
                    }
                }

                myModal.hide()
            })

            calendar.render();

            let myModal = new bootstrap.Modal(document.querySelector('#timekeepingModal'))
            let modalToggle = document.querySelector('.fc-addEventButton-button ')

            document.querySelector('#timekeepingModal').addEventListener('hidden.bs.modal', function (event) {
                    getModalStartDateEl.value = '';
                    let getModalIfCheckedRadioBtnEl = document.querySelector('input[name="event-level"]:checked');
                    if (getModalIfCheckedRadioBtnEl !== null) { getModalIfCheckedRadioBtnEl.checked = false; }
            });

            $('#working-status').change(function() {
                let isShow = $(this).find(':selected').data('show-ot');
                if(isShow) {
                    $('#form-work-type').removeClass('d-none');
                    $('#form-ot-time').removeClass('d-none');
                }
                else {
                    $('#form-work-type').addClass('d-none');
                    $('#form-ot-time').addClass('d-none');
                }
                $('#work-type').val('');
                $('#ot-time').val('');
            });

            document.querySelectorAll('.btn-timekeeping').forEach(btn => {
                btn.onclick = async () => {
                    $('#user-id').val(btn.dataset.userId);
                    $('#user-name').val(btn.dataset.userName);

                    await reloadCalendar();
                }
            });
        });
    </script>
@endsection
