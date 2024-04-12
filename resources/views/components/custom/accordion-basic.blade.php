<div class="row">
    <div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area" style="border-radius: 8px">
                <div id="iconsAccordion" class="accordion-icons accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne3">
                            <section class="mb-0 mt-0">
                                <div
                                    role="menu"
                                    class="collapsed"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#{{ $accordionId }}"
                                    aria-expanded="false"
                                    aria-controls="{{ $accordionId }}"
                                >
                                    <div class="accordion-icon">
                                        <i data-feather="{{ $accordionIcon }}"></i>
                                    </div>
                                    {{ $title }}
                                    <div class="icons">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="feather feather-chevron-down">
                                            <polyline points="6 9 12 15 18 9">
                                            </polyline>
                                        </svg>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <div
                            id="{{ $accordionId }}"
                            class="collapse"
                            aria-labelledby="headingOne3"
                            data-bs-parent="#iconsAccordion"
                            style=""
                        >
                            <div class="card-body">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
