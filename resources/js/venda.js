  $(document).ready(function() {
    var installmentData = []; 

    $("#btnCalcularParcelas").click(function() {
      var amount = parseFloat($("#amount").val()); 
      var plots = parseInt($("#plots").val());    

      if (!isNaN(amount) && !isNaN(plots) && plots > 0) {
        installmentData = []; 

        var installmentContainer = $("#installmentsContainer");
        installmentContainer.empty(); 

        var totalInstallmentsAmount = (amount).toFixed(2);

        for (var i = 1; i <= plots; i++) {
          var installmentValue = (amount / plots).toFixed(2);
          installmentData.push("");

          var inputAmount = $("<input>")
            .attr("type", "text")
            .attr("class", "form-control mb-2")
            .attr("name", "installment_" + i + "_amount")
            .attr("placeholder", "Parcela " + i)
            .val(installmentValue);

          var currentDate = new Date();
          var formattedDate = currentDate.toISOString().split('T')[0];

          var inputDate = $("<input>")
            .attr("type", "date")
            .attr("class", "form-control mb-2")
            .attr("name", "installment_" + i + "_date")
            .attr("placeholder", "Data Parcela " + i)
            .val(formattedDate);

          var row = $("<div>")
            .addClass("row mb-2")
            .append($("<div>").addClass("col").append(inputAmount))
            .append($("<div>").addClass("col").append(inputDate));

          installmentContainer.append(row);

          totalInstallmentsAmount = (parseFloat(totalInstallmentsAmount) + parseFloat(installmentValue)).toFixed(2);
        }
      }
    });
     $("#payment").change(function() {
      var selectedPayment = $(this).val();
      if (selectedPayment === "2") {
        $("#parcelasContainer").show();
        $("#installmentsContainer").show();
      } else {
        $("#parcelasContainer").hide();
        $("#installmentsContainer").hide();
      }
    });
  });
