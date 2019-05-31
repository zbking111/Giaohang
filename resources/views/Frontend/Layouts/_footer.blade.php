<footer style="background: #EBF6FB">
    <div class="container">
        <div class="row">
        <!--     <img src="{{ url('frontend') }}/images/img/ongVangIcon-no-bg.png" alt=""><br> -->
            <span class="copyright" style="font-size: 14px !important;">{{ @$contact->data->copy_right }}</span>
            <div class="link-group">
                <p>{{ @$contact->data->address }}</p>
                <span style="font-size: 14px !important;">Hotline: <b>{{ @$contact->data->phone }}</b> -</span>
                <span style="font-size: 14px !important;">Email: <a href=""><b>{{ @$contact->data->email }}</b></a></span>
                <br>
                <br>
            </div>
        </div>
    </div>
</footer>