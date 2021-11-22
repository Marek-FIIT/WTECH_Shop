$(document).ready(function () {
    var stepper = new Stepper($('.bs-stepper')[0]);
    Array.from(document.getElementsByClassName("btnNext")).forEach(button => button.addEventListener("click", () => { stepper.next(); }));
    Array.from(document.getElementsByClassName("btnPrev")).forEach(button => button.addEventListener("click", () => { stepper.previous(); }));

    var countryDropdown = document.getElementById("personalInfoCountry");
    Array.from(document.getElementsByClassName("dropdown-item country")).forEach(option => option.addEventListener("click", () => countryDropdown.innerHTML = option.innerHTML));

    var countryDropdown2 = document.getElementById("personalInfoCountry2");
    Array.from(document.getElementsByClassName("dropdown-item country2")).forEach(option => option.addEventListener("click", () => countryDropdown2.innerHTML = option.innerHTML));

    var sumPaymentDelivery = document.getElementById("sumPaymentDelivery");
    var sumProducts = document.getElementById("sumProducts");
    var paymentFee = document.getElementById("paymentFee");
    var deliveryFee = document.getElementById("deliveryFee");
    sumPaymentDelivery.innerHTML = "Celková cena: " + sumProducts.innerHTML.split(" ")[2].replace(",", ".") + " \u20AC";

    Array.from(document.getElementsByClassName("paymentRadio")).forEach(radio =>
    {
        if (radio.checked == true)
        {
            sumPaymentDelivery.innerHTML = "Celková cena: " + Number(
                                           Number(sumPaymentDelivery.innerHTML.split(" ")[2].replace(",", ".")) +
                                           Number(document.getElementById(radio.id.replace("radio", "price")).innerHTML.split(" ")[0].replace(",", "."))) + " \u20AC";

            document.getElementById("sumPaymentDeliveryTaxFree").innerHTML = "Celková cena bez DPH: " +
                                                                             (Number(sumPaymentDelivery.innerHTML.split(" ")[2].replace(",", ".")) * (1 / 1.2)).toFixed(2) + 
                                                                             " \u20AC";

            paymentFee.innerHTML = "Platba:  +" + document.getElementById(radio.id.replace("radio", "price")).innerHTML;
        }
        
        radio.addEventListener("click", (e) =>
        {
            var selectedPrice = document.getElementById(e.target.id.replace("radio", "price")).innerHTML;
            paymentFee.innerHTML = "Platba:  +" + selectedPrice;

            sumPaymentDelivery.innerHTML = "Celková cena: " + Number(
                                           Number(sumProducts.innerHTML.split(" ")[2].replace(",", ".")) +
                                           Number(deliveryFee.innerHTML.split("+")[1].split(" ")[0].replace(",", ".")) + 
                                           Number(selectedPrice.split(" ")[0].replace(",", "."))) + " \u20AC";

            document.getElementById("sumPaymentDeliveryTaxFree").innerHTML = "Celková cena bez DPH: " +
                                                                             (Number(sumPaymentDelivery.innerHTML.split(" ")[2].replace(",", ".")) * (1 / 1.2)).toFixed(2) + 
                                                                             " \u20AC";
        })
    });

    Array.from(document.getElementsByClassName("deliveryRadio")).forEach(radio =>
    {
        if (radio.checked == true)
        {
            //sumPaymentDelivery.innerHTML = sumPaymentDelivery.innerHTML.split(" ")[2] + document.getElementById(radio.id.replace("radio", "price")).innerHTML.split(" ")[0];
            sumPaymentDelivery.innerHTML = "Celková cena: " + Number(
                                           Number(sumPaymentDelivery.innerHTML.split(" ")[2].replace(",", ".")) +
                                           Number(document.getElementById(radio.id.replace("radio", "price")).innerHTML.split(" ")[0].replace(",", ".")))  + " \u20AC";

            document.getElementById("sumPaymentDeliveryTaxFree").innerHTML = "Celková cena bez DPH: " +
                                                                             (Number(sumPaymentDelivery.innerHTML.split(" ")[2].replace(",", ".")) * (1 / 1.2)).toFixed(2) + 
                                                                             " \u20AC";

            deliveryFee.innerHTML = "Doprava:  +" + document.getElementById(radio.id.replace("radio", "price")).innerHTML;
        }
        radio.addEventListener("click", (e) =>
        {
            var selectedPrice = document.getElementById(e.target.id.replace("radio", "price")).innerHTML;
            deliveryFee.innerHTML = "Doprava:  +" + selectedPrice;

            //sumPaymentDelivery.innerHTML = document.getElementById("sumProducts").innerHTML.split(" ")[2] + paymentFee.innerHTML.split("+")[1].split(" ")[0] + selectedPrice.split(" ")[0];
            sumPaymentDelivery.innerHTML = "Celková cena: " + Number(
                                           Number(sumProducts.innerHTML.split(" ")[2].replace(",", ".")) +
                                           Number(paymentFee.innerHTML.split("+")[1].split(" ")[0].replace(",", ".")) +
                                           Number(selectedPrice.split(" ")[0].replace(",", "."))) + " \u20AC";

            document.getElementById("sumPaymentDeliveryTaxFree").innerHTML = "Celková cena bez DPH: " +
                                                                             (Number(sumPaymentDelivery.innerHTML.split(" ")[2].replace(",", ".")) * (1 / 1.2)).toFixed(2) + 
                                                                             " \u20AC";
        })
    });

    document.getElementById("showPersonalInfo").addEventListener("click", () =>
    {
        document.getElementById("sumInfo").innerHTML = sumPaymentDelivery.innerHTML;
        document.getElementById("sumInfoTaxFree").innerHTML = "Celková cena bez DPH: " +
                                                              (Number(sumPaymentDelivery.innerHTML.split(" ")[2].replace(",", ".")) * (1 / 1.2)).toFixed(2) + 
                                                              " \u20AC";
    });
    document.getElementById("showSummary").addEventListener("click", () =>
    {
        document.getElementById("sumSummary").innerHTML = sumPaymentDelivery.innerHTML;
        document.getElementById("sumSummaryTaxFree").innerHTML = "Celková cena bez DPH: " +
                                                                 (Number(sumPaymentDelivery.innerHTML.split(" ")[2].replace(",", ".")) * (1 / 1.2)).toFixed(2) + 
                                                                 " \u20AC";
    });

    /*SUMMARY*/
    let content = document.getElementById("summaryContent");
    document.getElementById("hideSummary").addEventListener("click", () =>
    {
        content.innerHTML = "";
    });

    document.getElementById("showSummary").addEventListener("click", () =>
    {
        var productsH1 = document.createElement("H1");
        productsH1.innerHTML = "Products:";
        content.appendChild(productsH1);

        Array.from(document.getElementsByClassName("product")).forEach(product =>
        {
            //Products
            var div1 = document.createElement("div");
            div1.className = "card flex-row p-3 m-5";
            content.appendChild(div1);

            var div2 = document.createElement("div");
            div2.className = "row";
            div1.appendChild(div2);

            var image = new Image();
            var originalImage = document.getElementById("productImage" + product.id);
            image.src = originalImage.src;
            image.alt = originalImage.alt;
            image.className = "img-product ml-3";
            div2.appendChild(image);

            var div3 = document.createElement("div");
            div3.className = "card-basic p-0 mx-5";
            div2.appendChild(div3);

            var productName = document.createElement("H5");
            productName.className = "card-title";
            productName.innerHTML = document.getElementById("productName" + product.id).innerHTML;
            div3.appendChild(productName);

            var productSize = document.createElement("p");
            productSize.className = "card-text";
            productSize.innerHTML = document.getElementById("productSize" + product.id).innerHTML;
            div3.appendChild(productSize);
            var productColor = document.createElement("p");
            productColor.className = "card-text";
            productColor.innerHTML = document.getElementById("productColor" + product.id).innerHTML;
            div3.appendChild(productColor);

            var div4 = document.createElement("div");
            div4.className = "card-basic p-0 mx-5";
            div2.appendChild(div4);

            var priceSum= document.createElement("p");
            priceSum.className = "card-text";
            var price = document.getElementById("productPrice" + product.id).innerHTML;
            var count = document.getElementById("productCount" + product.id).innerHTML;
            priceSum.innerHTML = price + " x " + count + " = " + price.split(" ")[0] * count + " \u20AC";
            div4.appendChild(priceSum);

            //Delivery
            var deliveryH1 = document.createElement("H1");
            deliveryH1.innerHTML = "Delivery:";
            content.appendChild(deliveryH1);

            var div1 = document.createElement("div");
            div1.className = "card flex-row p-3 m-5";
            content.appendChild(div1);

            var div2 = document.createElement("div");
            div2.className = "row";
            div1.appendChild(div2);

            var delivery = document.createElement("p");
            delivery.className = "card-text";
            Array.from(document.getElementsByClassName("deliveryRadio")).forEach(radio =>
            {
                if (radio.checked == true)
                    delivery.innerHTML = document.getElementById(radio.id.replace("radio", "text")).innerHTML +
                                         " " + 
                                         document.getElementById(radio.id.replace("radio", "price")).innerHTML;
            });            
            div2.appendChild(delivery);

            //Payment
            var paymentH1 = document.createElement("H1");
            paymentH1.innerHTML = "Payment:";
            content.appendChild(paymentH1);

            var div1 = document.createElement("div");
            div1.className = "card flex-row p-3 m-5";
            content.appendChild(div1);

            var div2 = document.createElement("div");
            div2.className = "row";
            div1.appendChild(div2);

            var payment = document.createElement("p");
            payment.className = "card-text";

            Array.from(document.getElementsByClassName("paymentRadio")).forEach(radio => {
                if (radio.checked == true)
                    payment.innerHTML = document.getElementById(radio.id.replace("radio", "text")).innerHTML +
                        " " +
                        document.getElementById(radio.id.replace("radio", "price")).innerHTML;
            });
            div2.appendChild(payment);

            //Personal info
            var personalInfoH1 = document.createElement("H1");
            personalInfoH1.innerHTML = "Personal information:";
            content.appendChild(personalInfoH1);

            var div1 = document.createElement("div");
            div1.className = "card flex-row p-3 m-5";
            content.appendChild(div1);

            var div2 = document.createElement("div");
            div2.className = "row";
            div1.appendChild(div2);

            var firstName = document.createElement("p");
            firstName.className = "card-text";
            firstName.innerHTML = document.getElementById("personalInfoFirstName").value;
            div2.appendChild(firstName);
            div2.appendChild(document.createElement('br'));

            var lastName = document.createElement("p");
            lastName.className = "card-text";
            lastName.innerHTML = document.getElementById("personalInfoLastName").value;
            div2.appendChild(lastName);
            div2.appendChild(document.createElement('br'));

            var phone = document.createElement("p");
            phone.className = "card-text";
            phone.innerHTML = document.getElementById("personalInfoPhone").value;
            div2.appendChild(phone);
            div2.appendChild(document.createElement('br'));

            var email = document.createElement("p");
            email.className = "card-text";
            email.innerHTML = document.getElementById("personalInfoEmail").value;
            div2.appendChild(email);

            //Delivery address
            var deliveryAddressH1 = document.createElement("H1");
            deliveryAddressH1.innerHTML = "Delivery address:";
            content.appendChild(deliveryAddressH1);

            var div1 = document.createElement("div");
            div1.className = "card flex-row p-3 m-5";
            content.appendChild(div1);

            var div2 = document.createElement("div");
            div2.className = "row";
            div1.appendChild(div2);

            var deliveryAddrress = document.createElement("p");
            deliveryAddrress.className = "card-text";
            deliveryAddrress.innerHTML = document.getElementById("personalInfoCountry").innerHTML +
                                         " - " + 
                                         document.getElementById("personalInfoStreet").value +
                                         ", " + 
                                         document.getElementById("personalInfoPSC").value + 
                                         ", " + 
                                         document.getElementById("personalInfoCity").value;
            div2.appendChild(deliveryAddrress);

            //Billing address
            var billingAddressH1 = document.createElement("H1");
            billingAddressH1.innerHTML = "Billing address:";
            content.appendChild(billingAddressH1);

            var div1 = document.createElement("div");
            div1.className = "card flex-row p-3 m-5";
            content.appendChild(div1);

            var div2 = document.createElement("div");
            div2.className = "row";
            div1.appendChild(div2);

            var billingAddrress = document.createElement("p");
            billingAddrress.className = "card-text";
            billingAddrress.innerHTML = document.getElementById("personalInfoCountry2").innerHTML +
                                        " - " + 
                                        document.getElementById("personalInfoStreet2").value +
                                        ", " + 
                                        document.getElementById("personalInfoPSC2").value + 
                                        ", " + 
                                        document.getElementById("personalInfoCity2").value;
            div2.appendChild(billingAddrress);
        });
    });
});
