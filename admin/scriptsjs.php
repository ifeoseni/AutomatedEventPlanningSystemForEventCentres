

<script>

    //payment own
    let paidDay = pDay;
    let paidMonth = pMonth;
    let paidYear = pYear;

    //others
   let DayArray = Day;
  let MonthArray = Month;
   let YearArray =Year;

   for (var i = 0; i < MonthArray.length; i++) {
       MonthArray[i] = MonthArray[i]-1;
   }

    for (var i = 0; i < paidMonth.length; i++) {
       paidMonth[i] = paidMonth[i]-1;
   }




let today = new Date();
let currentMonth = today.getMonth();
let currentYear = today.getFullYear();
let selectYear = document.getElementById("year");
let selectMonth = document.getElementById("month");

let months = ["January,", "February,", "March,", "April,", "May,", "June,", "July,", "August,", "September,", "October,", "November,", "December,"];

let monthAndYear = document.getElementById("monthAndYear");
showCalendar(currentMonth, currentYear);


function next() {
    currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
    currentMonth = (currentMonth + 1) % 12;
    showCalendar(currentMonth, currentYear);
}

function previous() {
    currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
    showCalendar(currentMonth, currentYear);
}

function jump() {
    currentYear = parseInt(selectYear.value);
    currentMonth = parseInt(selectMonth.value);
    showCalendar(currentMonth, currentYear);
}

function showCalendar(month, year) {

    let firstDay = (new Date(year, month)).getDay();
    let daysInMonth = 32 - new Date(year, month, 32).getDate();

    let tbl = document.getElementById("calendar-body"); // body of the calendar

    // clearing all previous cells
    tbl.innerHTML = "";

    // filing data about month and in the page via DOM.
    monthAndYear.innerHTML = "<h3 class='text-center font-weight-bold text-dark'>"+ months[month] + " " + year+"</h3>";
    selectYear.value = year;
    selectMonth.value = month;

    // creating all cells
    let date = 1;

    
    for (let i = 0; i < 80; i++) {//6 is the default value but seems a bug is here
        // creates a table row
        let row = document.createElement("tr");

        //creating individual cells, filing them up with data.
        for (let j = 0; j < 7; j++) {
            if (i === 0 && j < firstDay) {
                let cell = document.createElement("td");
                let cellText = document.createTextNode("");
                cell.appendChild(cellText);
                row.appendChild(cell);
            }
            else if (date > daysInMonth) {
                break;
            }

            else {
                
                
                let cell = document.createElement("td");
                let cellText = document.createTextNode(date);
                if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                    cell.classList.add("bg-dark");cell.classList.add("text-white");
                } // color today's date

                
               

                for ( i = 0; i < DayArray.length; i++) {
                   
                    if (date == DayArray[i] && year == YearArray[i] && month == MonthArray[i] ) {
                    cell.classList.add("bg-danger"); cell.classList.add("text-warning");
                     }
                }
                 for ( i = 0; i < pDay.length; i++) {                   
                    if (date == paidDay[i] && year == paidYear[i] && month == paidMonth[i] ) {
                    cell.classList.remove("bg-danger"); cell.classList.remove("text-warning");
                    cell.classList.add("bg-success"); cell.classList.add("text-white");
                     }

                }

                

                
                
                cell.appendChild(cellText);
                row.appendChild(cell);
                date++;
            }


        }

        tbl.appendChild(row); // appending each row into calendar body.
    }

}

</script>