jQuery(document).ready(function() {
    $("#addReservationRule").validate({
        rules: {
            no_of_people: 'required',
            time_period: 'required',
            reservation_type: 'required',
            timezone: 'required',
        }
   });
   $('#no_of_people').keyup(function(e){
        if (/\D/g.test(this.value))
        {
            this.value = this.value.replace(/\D/g, '');
        }
    });
});

function myFunction(id) {
    let text = "Are you sure you want to delete this Rule ?";
    if (confirm(text) == true) {
        window.location.href="delete_rule/"+id;
    } else {
        return false;
    }
}