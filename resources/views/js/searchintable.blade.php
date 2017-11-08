<script>
    function cari() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("{{ $inputId }}");
        filter = input.value.toUpperCase();
        table = document.getElementById("{{ $tableId }}");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[parseInt({{ $fieldIndex }})];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    tr[i+1].style.display = "";
                } else {
                    tr[i].style.display = "none";
                    tr[i+1].style.display = "none";
                }
            }
        }
    }
</script>