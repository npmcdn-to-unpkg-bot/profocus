@extends('template')
@section('title')
        {{ $page[0]['title'] }}
@stop
@section('content')
    <? if( request()->route()->getName() != 'home' ) echo '<div class="offset" style="padding-top: 90px;"></div>'; ?>
    <div class="light-wrapper" id="rent">
        <div class="container inner">




                <h3 class="section-title ">{{ $page[0]['title'] }}</h3>

                <div class="morer">
                    {!! $page[0]['body'] !!}
                </div>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.light-wrapper -->
    <div class="dark-wrapper" id="rules">
        <div class="container inner">
            <div class="row">
                <div class="col-sm-12">
                    <h3 data-toggle="modal" data-target=".bs-example-modal-lg" style="cursor: pointer" class="text-center">Правила аренды</h3>
                    <!--/.feature -->
                </div>
            </div>
            <!--/.row -->
        </div>
        <!--/.container -->
    </div>
    <div class="light-wrapper" id="locations">
        <div class="container inner">
            <!-- /.thin -->


            <div class="row">
                @foreach( $locations as $location )
                <div class="col-sm-4">
                    <div class="caption-overlay">
                        <figure><a href="{{ url('/rent',$location['id']) }}"><img src="{{ url($location['thumbnail']) }}" alt="" /></a></figure>
                        <div class="caption bottom-right">
                            <div class="title">
                                <h3 class="main-title layer">{{ $location['title'] }}</h3>
                            </div>
                            <!--/.title -->
                        </div>
                        <!--/.caption -->
                    </div>
                </div>
                @endforeach
                <!-- /column -->

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->
    </div>
    <!-- /.light-wrapper -->

    <div class="light-wrapper" id="booking">
        <div class="container inner">
            <!-- <h3 class="section-title">фотографы</h3>
            <div class="hr5" style="margin-top: 20px; margin-bottom: 50px;"></div> -->
            <!-- /.thin -->

            <form action="" id="reservedData">
                <div class="row">
                    <div class="col-lg-3">
                        <style>
                            .places{
                                border: 1px solid #ccc;
                            }
                            .places div:first-child{
                                display: block;
                            }
                            .places div:last-child{
                                display: block;
                                border-bottom: 1px solid transparent;
                            }
                            .places div{
                                display: block;
                                border-bottom: 1px solid #ccc;
                                padding:0 10px 0 10px;
                                cursor: pointer;
                            }
                        </style>


                        <div class="places" style="height: 200px; backg1round: red; overflow: auto">

                            @foreach( $locations as $place )
                                <div class="locss" data-value="place{{ $place['id'] }}" id="place{{ $place['id'] }}">{{ $place['title'] }}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-9">

                        <div class="calendar">
                            <input type="text" id="datetimepicker" />
                            <br>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="orders">
                            <ul id="reserved-dates">
                            </ul>
                            <div id="reserved-total-price"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="text" placeholder="Имя" name="name" id="orderName">
                        <input type="text" placeholder="Телефон" name="phone" id="orderPhone">
                        <textarea name="description" cols="30" rows="10"></textarea>
                        <a id="send-data">go</a>
                    </div>
                </div>
            </form>

                <!-- /column -->
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.light-wrapper -->
<div class="light-wrapper" id="equipment">
        <div class="container inner">
            <!-- <h3 class="section-title">фотографы</h3>
            <div class="hr5" style="margin-top: 20px; margin-bottom: 50px;"></div> -->
            <!-- /.thin -->
            <div class="row">
                    <div class="col-sm-12">
                        <h3 class="section-title">{{$stuff[0]['title']}}</h3>
                        {!! $stuff[0]['body'] !!}
                    </div>

                <!-- /column -->
            </div>
            <!-- /.row -->
            <div class="carousel-wrapper">
                <div class="carousel carousel-boxed blog">

                 @foreach( $equipment as $ec)

                    <div class="item post">
                        <figure class="main"><img src="{{ url($ec['thumbnail'])  }}" alt="" /></figure>
                        <div class="box text-center">
                            <h4 class="post-title"><a href="">{{ $ec['title']  }}</a></h4>
                        </div>
                        <!-- /.box -->

                    </div>
                    <!-- /.post -->
                    @endforeach

                </div>
                <!--/.carousel -->
            </div>
            <!--/.carousel-wrapper -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.light-wrapper -->

    <script type='text/javascript'>
       <?
        $js_array = json_encode($json);
        echo "reservedDates = ". $js_array . ";\n";
        ?>
    </script>



@stop

@section('footer')
    <script>
        $(document).ready(function(){
            $('body .locss').on("click",function(){
                self = $(this);
                self.toggle("background","#fff");
                self.toggle("background","#e7e7e7");
            });

            $(".places").niceScroll();
        });
    </script>
    <script>



        var OrderPicker = function(){

            var orders = '{ "place1": { "7": [  { "day":"27", "reservedHour": [17, 19] }, { "day":"24", "reservedHour": [18,20] } ] }, \
                   "place2":  { "7": [ { "day":"23", "reservedHour": [18, 20] }, { "day":"25", "reservedHour": [14,16] } ] } }';
            var defaultOrders = '[ \
                                    { \
                                    "id": 1, \
                                    "place": 39, \
                                    "place_title": "place1", \
                                    "time": "2016-08-03 21:00:00", \
                                    "discount": 20, \
                                    "state": "null" \
                                    }, \
                                    { \
                                    "id": 1, \
                                    "place": 39, \
                                    "place_title": "place1", \
                                    "time": "2016-08-03 23:00:00", \
                                    "discount": 30, \
                                    "state": "null" \
                                    }, \
                                    { \
                                    "id": 2, \
                                    "place": 39, \
                                    "place_title": "place1", \
                                    "time": "2016-08-04 20:00:00", \
                                    "state": "broned" \
                                    }, \
                                    { \
                                    "id": 2, \
                                    "place": 39, \
                                    "place_title": "place1", \
                                    "time": "2016-08-04 22:00:00", \
                                    "discount": 30, \
                                    "state": "null" \
                                    }, \
                                    { \
                                    "id": 2, \
                                    "place": 39, \
                                    "place_title": "place1", \
                                    "time": "2016-08-05 20:00:00", \
                                    "discount": 30, \
                                    "state": "broned" \
                                    }, \
                                    { \
                                    "id": 2, \
                                    "place": 39, \
                                    "place_title": "place2", \
                                    "time": "2016-08-13 10:00:00", \
                                    "discount": 30, \
                                    "state": "broned" \
                                    }, \
                                    { \
                                    "id": 2, \
                                    "place": 39, \
                                    "place_title": "place2", \
                                    "time": "2016-08-14 11:00:00", \
                                    "discount": 30, \
                                    "state": "broned" \
                                    }, \
                                    { \
                                    "id": 2, \
                                    "place": 39, \
                                    "place_title": "place2", \
                                    "time": "2016-08-15 12:00:00", \
                                    "discount": 30, \
                                    "state": "broned" \
                                    } \
                                ]';
            var currentReservedDates = $.parseJSON(orders);
//            var defaultOrdersObject = $.parseJSON(defaultOrders);
            var defaultOrdersObject = reservedDates;
            var defaultOrdersDates = function(){
                var time, month, day, hour, order, orderTree = {};
                for (i in defaultOrdersObject){
                    order = defaultOrdersObject[i];
                    place = order.place_title
                    time = new Date(order.time);
                    month = time.getMonth();
                    day = time.getDate();
                    hour = time.getHours();
                    if ( !orderTree[place] ){
                        orderTree[place]={};
                    }
                    if ( !orderTree[place][month] ){
                        orderTree[place][month] = {};
                    }
                    if ( !orderTree[place][month][day] ){
                        orderTree[place][month][day] = {};
                    }


                    if (order.discount) {
                        if (!orderTree[order.place_title][month][day]['discount']){
                            orderTree[order.place_title][month][day]['discount'] = {};
                        }
                        orderTree[order.place_title][month][day]['discount'][hour] = order.discount;
                    }

                    if (order.state == 'broned') {
                        if ( !orderTree[order.place_title][month][day]['bronned']) {
                            orderTree[order.place_title][month][day]['bronned'] = [];
                        }
                        orderTree[order.place_title][month][day]['bronned'].push(hour);
                    }

                }
                return orderTree;
            }();

            var targetDay= 0;
            var targetHours= false;
            var activePlace= "Локация №1";
            var defaultPrice = 100;
            var targetHoursData= [];
            var selectedHoursData= [];
            var currentReservedHoursData = [];
            var currentDiscountHoursData = [];
            var currentSessionDates={};

            var getCurrentMonth = function (){
                return $('#datetimepicker').datetimepicker('getValue').getMonth() + 1;
            };




            var DefaultDate = function(){
                // calendar helpers
                var yesterday = function(){
                    var today = new Date();
                    var dd = today.getDate();

                    var mm = today.getMonth()+1; //January is 0!

                    var yyyy = today.getFullYear();
                    if(dd<10){
                        dd='0'+dd
                    }
                    if(mm<10){
                        mm='0'+mm
                    }
                    var yesterday = dd+'.'+mm+'.'+yyyy;
                    return yesterday;
                }();
                var month = function(){
                    var today = new Date();
                    return today.getMonth();
                }();
                var maxDate = function(maxMonth){
                    var today = new Date();
                    var dd = today.getDate(),year;

                    var mm = today.getMonth() + maxMonth;

                    if ( mm > 12 ){
                        yyyy = today.getFullYear() +1;
                        mm = mm-12;
                    } else {
                        yyyy = today.getFullYear()
                    }

                    yyyy = today.getFullYear();
                    if(dd<10){
                        dd='0'+dd
                    }
                    if(mm<10){
                        mm='0'+mm
                    }
                    return dd+'.'+mm+'.'+yyyy;
                };
                return {
                    returnYesterday: function(){
                        return yesterday;
                    },
                    returnMaxDate: function(maxMonth){
                        return maxDate(maxMonth);
                    }
                }
            }();




            var View = function(){


                function setDefaultDates(){

                    if (defaultOrdersDates){
                        var currentDay;
                        var placeDate = defaultOrdersDates[activePlace];
                        var month = getCurrentMonth() -1;
                        if (placeDate){
                            var mothData = placeDate[month];
                            if (mothData){
                                for (el in mothData ) {
                                    currentDay = $('[data-date=' + el + '][data-month=' + (month) + ']');
                                    if (mothData[el].bronned && mothData[el].bronned.length != 0){
                                        currentDay.addClass('bronned');
                                    }
                                    if (mothData[el].discount && !$.isEmptyObject(mothData[el].discount)){
                                        currentDay.addClass('discount');
                                    }

                                }
                                /*                                for (var i=0; i<mothData.length; i++){
                                 $('[data-date=' + mothData[i].day + '][data-month=' + (month-1) + ']').addClass(placeClass);
                                 }
                                 */

                            }
                        }
                    }

                    targetCell =  $('[data-date=' + targetDay + '][data-month=' + (getCurrentMonth()-1) + ']');
                    targetCell.addClass('selected');
                }
                function setCurrentSessionDates(){

                    if (currentSessionDates){
                        var currentDay;
                        var placeDate = currentSessionDates[activePlace];
                        var month = getCurrentMonth() ;
                        if (placeDate){
                            var mothData = placeDate[month];
                            if (mothData){
                                for (el in mothData ) {
                                    $('[data-date=' + el + '][data-month=' + (month -1) + ']').addClass('currentOrder');

                                }
                                /*                                for (var i=0; i<mothData.length; i++){
                                 $('[data-date=' + mothData[i].day + '][data-month=' + (month-1) + ']').addClass(placeClass);
                                 }
                                 */

                            }
                        }
                    }
                }

                function setDayHours(){
                    setClassForHours(targetHoursData, 'bronned');
                    setClassForHours(currentReservedHoursData, 'currentOrder');
//                    setClassForHours(currentReservedHoursData, 'selected');
                    setClassForHours(selectedHoursData, 'selected');
                    setClassForDiscountHours(currentDiscountHoursData, 'discount');
                }

                function setClassForHours(hours, className){
                    $('[data-hour].' + className).removeClass(className);
                    if (hours.length != 0) {
                        for (var i=0; i<hours.length; i++){
                            $('div[data-hour=' + hours[i] + ']').addClass(className);
                        }
                    }
                }

                function setClassForDiscountHours(hours, className){
                    $('[data-hour].' + className).removeClass(className);
                    for (var i=0 in hours){
                        $('[data-hour=' + i + ']').addClass(className);
                        $('div[data-hour=' + i + ']')[0].innerHTML += '<span class="green-text">' + ' Скидка' + hours[i] + '%</span>';
                    }
                }


                function updateCurrentOrders(){
                    if ( $('.xdsoft_time.selected').length == 0 ) {
                        var playce = currentSessionDates[activePlace];
                        if (playce){
                            var month = getCurrentMonth();
                            var days = currentSessionDates[activePlace][month];
                            if (days){
                                for (var i=0; i<currentSessionDates[activePlace][month].length; i++){
                                    if ( currentSessionDates[activePlace][month][i]['hours'].length == 0 ){
                                        currentSessionDates[activePlace][month].splice(i,1);
                                    }
                                }
                            }
                        }
                    }
                }


                return {

                    getCurrentDay: function(){
                        return $('#datetimepicker').datetimepicker('getValue').getDate();
                    },

                    selectPlace: function(){
                        var target = $(event.target)[0];
                        placeId = target.value;
                        activePlace = placeId;
                        selectedHoursData = [];
                        currentReservedHoursData = [];
                        $('#datetimepicker').datetimepicker('reset');
                        /*                        if ($('.xdsoft_date.currentOrder.selected').length == 0) {
                         $('xdsoft_time.currentOrder').removeClass('currentOrder');
                         }*/
                    },
                    selectDates: function (){
                        var target = $(event.target).parent();
                        var targetData = target.data('date');
                        var month = getCurrentMonth() -1;
                        targetDay = (targetDay == targetData) ?  0 : targetData;
                        targetHoursData = target.hasClass('bronned') ? defaultOrdersDates[activePlace][month][targetData].bronned : [];
                        currentReservedHoursData = target.hasClass('currentOrder') ? Object.keys(currentSessionDates[activePlace][month +1 ][targetData]) : [];
                        currentDiscountHoursData = target.hasClass('discount') ? defaultOrdersDates[activePlace][month][targetData]['discount'] : [];
                        selectedHoursData = currentReservedHoursData;

                    },
                    selectTime: function (){

                        var target = $(event.target);
                        var hour = target.data('hour').toString();
                        var selectedDataIndex = selectedHoursData.indexOf( hour );
                        if ( selectedDataIndex > -1 ){
                            selectedHoursData.splice(selectedDataIndex, 1);
                        } else {
                            selectedHoursData.push(hour);
                        }
//                        Orders.addData();

                    },
                    update: function(){
                        setDefaultDates();
                        setCurrentSessionDates();
                        setDayHours();
                        Orders.addData();
                        $('.xdsoft_current').removeClass('xdsoft_current');
                        $('.xdsoft_today').removeClass('xdsoft_today');
                    }
                }

            }();


            var Orders = function(){
                function getReservedData(container){
                    var data = {};
                    container.each(function(i){
                        var self= $( this );
                        data[i] = self.text();
                    });
                    return data;
                }
                function updateReservedDates(){
//                    var month = getCurrentMonth();
                    var output = '';
                    var hourDiscount = 0;
                    var sumPrice;
                    var hourPrice;
                    sumPrice = 0;
                    for (var currentPlace in currentSessionDates){
                        for (var month in currentSessionDates[currentPlace]){
                            for (var day in currentSessionDates[currentPlace][month]){
                                output += '<li><span>'+ currentPlace + ' ' + month + ' ' + day + '</span><ul>';
                                for (var hour in currentSessionDates[currentPlace][month][day]){
                                    output += '<li><span>'+ hour + '-00 </span>';
                                    hourDiscount = currentSessionDates[currentPlace][month][day][hour];
                                    if (  hourDiscount != 0 ){
                                        hourPrice = (defaultPrice - defaultPrice*hourDiscount/100);
                                        output += '<span> '+ hourDiscount + '</span>';
                                    } else {
                                        hourPrice = defaultPrice;
                                    }
                                    sumPrice += hourPrice;
                                    output += '<span> '+ hourPrice + '</span>';
                                    output += '<i class="fa fa-times" data-place="' + currentPlace + '" data-month="' + month + '" data-day="' + day + '" data-hour="' + hour + '"></i>';
                                    output += '</li>';
                                }
                                output += '</ul></li>';

                            }
                        }
                    }
                    $('#reserved-dates').html(output);
                    if (sumPrice != 0 ) {
                        $('#reserved-total-price').html(sumPrice);
                    } else {
                        $('#reserved-total-price').html('');
                    } 
                }

                function deleteHourDayMonthPlace(hour, day, month, place){
                    if ( currentSessionDates[place] && currentSessionDates[place][month] && currentSessionDates[place][month][day] && ( currentSessionDates[place][month][day][hour] != undefined ) ) {


                            delete currentSessionDates[place][month][day][hour];

                            if ($.isEmptyObject(currentSessionDates[place][month][day])){
                                delete currentSessionDates[place][month][day];
                            }

                            if ( (place == activePlace) && ( $('[data-date=' + day + '][data-month=' + (month - 1) + ']').hasClass('currentOrder') )){
                                $('[data-hour=' + hour+ ']').removeClass('currentOrder selected');
                            }



                            updateReservedDates();


                    }

                }


                return {
                    addData: function(){
                        var hourSelected = $('.xdsoft_time.selected');
                        var discountSelected = $('.xdsoft_time.selected.discount');
                        var day = $('.xdsoft_date.selected');
                        var month = getCurrentMonth();
                        var dayData = $('.xdsoft_date.selected').data('date');
                        if ( hourSelected.length !=0 && day.length !=0){
                            var hours = hourSelected.map(function(i,el){return $(el).data('hour')});
                            var discount = discountSelected.map(function(i,el){return $(el).data('hour')});

                            if (!currentSessionDates[activePlace]) {
                                currentSessionDates[activePlace] = {};
                            }

                            if (!currentSessionDates[activePlace][month]) {
                                currentSessionDates[activePlace][month] = {};
                            }

                            /*                            if ( !currentSessionDates[activePlace][month][dayData] ){
                             currentSessionDates[activePlace][month][dayData] = {};
                             }*/
                            currentSessionDates[activePlace][month][dayData] = {};
                            for (var i = 0; i < hours.length; i++){
                                if ( defaultOrdersDates[activePlace][month-1][dayData] && defaultOrdersDates[activePlace][month-1][dayData].discount[hours[i]] ) {
                                    currentSessionDates[activePlace][month][dayData][hours[i]] = defaultOrdersDates[activePlace][month-1][dayData].discount[hours[i]];
                                } else {
                                    currentSessionDates[activePlace][month][dayData][hours[i]] = 0;
                                }
                            }

                            /*                            currentSessionDates[activePlace][month][dayData]['reserved'] = hours;
                             currentSessionDates[activePlace][month][dayData]['discount'] = discount;*/


                            day.addClass('hasReserved');
                            hourSelected.addClass('hasReserved');

                            //                    $('.selected').removeClass('selected');


                        }

                        if ( day.length !=0 && hourSelected.length ==0 ){
                            if (currentSessionDates[activePlace]) {
                                if (currentSessionDates[activePlace][month]) {
                                    if (currentSessionDates[activePlace][month][dayData]) {
                                        delete currentSessionDates[activePlace][month][dayData];
                                    }
                                    if ($.isEmptyObject(currentSessionDates[activePlace][month]))
                                    {
                                        delete currentSessionDates[activePlace][month];
                                    }
                                }
                            }
                        }

                        if (  hourSelected.length == 0 ){
                            day.removeClass('currentOrder');
                        } else {
                            day.addClass('currentOrder');
                        }


                        updateReservedDates();
                    },
                    deleteHour: function(e){
                        var target = $(e.target);
                        deleteHourDayMonthPlace( target.data('hour'), target.data('day'), target.data('month'), target.data('place'));
                    },
                    sendData: function(){
//                        var reverved = getReservedData( $('#reserved-dates li') );
                        var reverved = currentSessionDates;
                        var name = $('#orderName').val();
                        var order = $('#orderPhone').val();
                        if ( $.isEmptyObject(reverved) ){
                            swal({
                                type: "warning",
                                title: "Ошибка!",
                                text: "Пожалуйста, выберите время для фотосъёмки!",
                                showConfirmButton: true,
                                showCancelButton: false,
                                closeOnConfirm: false
                            });
                        } else if ( ( name.length == 0 ) || ( order.length == 0 ) ){
                            swal({
                                type: "warning",
                                title: "Ошибка!",
                                text: "Имя и телефон обязательны для заполнения !",
                                showConfirmButton: true,
                                showCancelButton: false,
                                closeOnConfirm: false
                            });
                        } else {
                            reverved.name = name;
                            reverved.order = order;
                            $.ajax({
                                type: 'POST',
                                url: 'rent',
                                data: reverved,
                                success: function(data){

                                    swal({
                                        type: "success",
                                        title: "Успех",
                                        text: "Заявка в обработке!",
                                        showConfirmButton: false,
                                        showCancelButton: false,
                                        closeOnConfirm: false,
                                        timer: 1000
                                    });

                                },
                                error: function (data) {
                                    alert("reservedData error");
                                },
                                beforeSend: function (xhr) {
                                    var token = $('meta[name="csrf_token"]').attr('content');

                                    if (token) {
                                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                                    }
                                }
                            });
                        }

                    }

                }
            }();



            return {
                update: View.update,
                selectPlace: View.selectPlace,
                selectDates: View.selectDates,
                selectTime: View.selectTime,
                minDate: DefaultDate.returnYesterday,
                maxDate: DefaultDate.returnMaxDate(2),
                sendData: Orders.sendData,
                addData: Orders.addData,
                deleteHour: Orders.deleteHour
            };


        }();

        $(document).ready( function(){
            $('#datetimepicker').datetimepicker({
                format:'d.m.Y H:i',
                inline:true,
                lang:'ru',
                onGenerate: OrderPicker.update,
                onSelectDate: OrderPicker.selectDates,
                onSelectTime: OrderPicker.selectTime,
                minDate: OrderPicker.returnYesterday,
//                maxDate: OrderPicker.returnMaxDate(2),
                formatDate:'d.m.Y',
                defaultSelect: false,
                scrollMonth: false,
                scrollTime: false
            });
//            $('#add-data').on( 'click', OrderPicker.addData);
            $('#place1, #place2, #place3').change(OrderPicker.selectPlace);
            $('#add-data').on( 'click', OrderPicker.addData);
            $('#send-data').on('click', OrderPicker.sendData);
            $('body').on('click', '.fa-times', OrderPicker.deleteHour);

        });




    </script>
    <style>


        .bronned{
            background-color: pink!important;
            color: #000!important;
        }

        .discount{
            border: 2px solid green!important;
        }

        .currentOrder{
            background-color: #EF5!important;
        }

        .selected{
            font-weight: 700;
        }

        .green-text{
            color: green;
        }

        .xdsoft_datetimepicker{
            width: 100%;
        }
        .xdsoft_datepicker{
            width: 70%!important;
            margin: 0!important;
            padding: 15px!important;
        } 
        .xdsoft_timepicker{
            width: 30%!important;
            margin: 0!important;
            padding: 15px!important;
        }

        .xdsoft_prev, .xdsoft_next{
            margin-left: auto!important;
            margin-right: auto!important;
        }


    </style>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ $stuff[1]['title'] }}</h4>
                </div>
                <div class="modal-body">
                    {!! $stuff[1]['body'] !!}
                </div>
                <div class="modal-footer">
                    <label title="OK!" id="download" class="btn btn-primary">
                        <button type="submit" class="hide"></button>
                        OK!
                    </label>
                </div>
            </div>
        </div>
    </div>
@stop