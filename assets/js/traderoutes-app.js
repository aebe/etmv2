"use strict";
$(document).ready(function() {

    $(".origin-station").focus().select();
    var base = $(".navbar").attr('data-url');
    var url = base + "Traderoutes/searchStations";
    var id = $(".navbar").attr('data-id'); 

    function list() {
        var listurl = base + "Traderoutes/listTradeRoutes/" + id; 
        $.ajax({
            dataType: "json",
            url: listurl,
            global: false,
            success: function(result) {
                $("table tbody tr").empty();
                if (result.length == 0) {
                    var $row = "<tr><td colspan='3' class='text-center'>No trade routes present. Create one at the left</td></tr>";
                    $("table").prepend($row);
                } else {
                    $.each(result, function(k, v) {
                        var iddel = result[k].id;
                        var $row = "<tr><td>" + result[k].s1 + "</td><td>" + result[k].s2 + 
                            "</td><td><button class='btn btn-danger btn-delete' data-iddel=" + iddel + ">Delete</button></tr></tr>";
                        $("table").prepend($row);
                    });
                }
            }
        }); 
    }
    list();

    $(".origin-station, .destination-station").autocomplete({
        source: url,
        minLength: 2,
        messages: {
            noResults: '',
        },
        select: function(event, ui) {
            if ($(this).hasClass('origin-station')) {
                $(".origin").val(ui.item.value);
            } else {
                $(".destination").val(ui.item.value);
            }
        }
    });

    $(".submit-traderoute").on('click', function(e) {
        e.preventDefault();

        var origin_val = $(".origin-station").val();
        var dest_val = $(".destination-station").val();
        $(".origin").val(origin_val);
        $(".destination").val(dest_val);
        url = base + "Traderoutes/submitRoute/" + id;

        var data = $(".form-horizontal").serialize();
        $.ajax({
            dataType: "json",
            url: url,
            global: false,
            data: data,
            type: "POST",
            success: function(result) {
                toastr[result.notice](result.message);
                $(".origin-station, .destination-station").val("");
                list();
            }
        });
    });
    
    $("table").on('click', 'button', function() {
        var $this = $(this);
        var url = base + "Traderoutes/" + "deleteRoute/" + $(this).attr('data-iddel');

        $.ajax({
            dataType: "json",
            url: url,
            global: false,
            success: function(result) {
                $this.closest("tr").remove();
                toastr[result.notice](result.message);
                list();
            }
        });
    });
});