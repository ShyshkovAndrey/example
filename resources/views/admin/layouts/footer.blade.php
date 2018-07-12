</main>
</div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $(".select2").select2();

    $('document').ready(function () {


        $('.permission-group').on('change', function(){

            $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
        });

        $('.permission-select-all').on('click', function(){
            console.log(1)
            $('ul.permissions').find("input[type='checkbox']").prop('checked', true);
            return false;
        });

        $('.permission-deselect-all').on('click', function(){
            $('ul.permissions').find("input[type='checkbox']").prop('checked', false);
            return false;
        });

        function parentChecked(){
            $('.permission-group').each(function(){
                var allChecked = true;
                $(this).siblings('ul').find("input[type='checkbox']").each(function(){
                    if(!this.checked) allChecked = false;
                });
                $(this).prop('checked', allChecked);
            });
        }

        parentChecked();

        $('.the-permission').on('change', function(){
            parentChecked();
        });
    });
</script>

</body>
</html>