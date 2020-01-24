@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div id="update-nav">
                    <div id="range-selector">
                        <input type="button" id="1m" class="period ui-button" value="1m"/>
                        <input type="button" id="3m" class="period ui-button" value="3m"/>
                        <input type="button" id="6m" class="period ui-button" value="6m"/>
                        <input type="button" id="1y" class="period ui-button" value="1y"/>
                        <input type="button" id="all" class="period ui-button" value="All"/>
                    </div>
                    <div id="date-selector">
                        From:<input type="text" id="fromDate" class="ui-widget">
                        To:<input type="text" id="toDate" class="ui-widget">
                    </div>
                </div>
                <div id="chartContainer" style="height: 360px; width: 100%;"></div>
            </div>
            <div class="row">
                <div class="card card-chart">
                    <div class="card-header card-header-success">
                        <div class="ct-chart"></div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Customer Retention Rate</h4>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> updated 4 minutes ago
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            // Javascript method's body can be found in assets/js/demos.js
            md.initDashboardPageCharts();
        });
    </script>
@endpush
