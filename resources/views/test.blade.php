<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
        <script type="text/javascript" src="resources/js/jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                $('#btnn').click(function () {
                    alert("opop");
                })
            })
        </script>
    </head>
    <body>
        <input type="button" id="btnn" value="yes">
    </body>
</html>
