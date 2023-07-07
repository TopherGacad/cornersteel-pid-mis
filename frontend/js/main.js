// MAIN CONTENT CONTAINERS
const dashContain = document.getElementById("dash-container")
const shiftsContain = document.getElementById("shifts-container")
const overtimeContain = document.getElementById("overtime-container")
const offBusContain = document.getElementById("offBusiness-container")

//BUTTONS
const dashBtn = document.getElementById("dash-btn")
const shiftsBtn = document.getElementById("shifts-btn")
const overtimeBtn = document.getElementById("overtime-btn")
const offBusBtn = document.getElementById("offBusiness-btn")

// // MAIN CONTENTS CONTAINER SELECTOR
// dashBtn.addEventListener("click", function(){
//     renderDash()
// })
// shiftsBtn.addEventListener("click", function(){
//     renderShift()
// })
// overtimeBtn.addEventListener("click", function(){
//     renderOT()
// })
// offBusBtn.addEventListener("click",function(){
//     renderOffBus()
// })

//=========RENDERING FUNCTIONS==========//
// function renderDash(){
//   //MAIN CONTENT ACTIVATOR
//   dashContain.style.display = "block"
//   shiftsContain.style.display = "none"
//   overtimeContain.style.display = "none"
//   offBusContain.style.display = "none"

//   //BUTTON ACTIVE STYLING
//   dashBtn.classList.add('btn-active')
//   shiftsBtn.classList.remove('btn-active')
//   overtimeBtn.classList.remove('btn-active')
//   offBusBtn.classList.remove('btn-active')
// }

// function renderOT(){
//   //MAIN CONTENT ACTIVATOR
//   dashContain.style.display = "none"
//   shiftsContain.style.display = "none"
//   overtimeContain.style.display = "block"
//   offBusContain.style.display = "none"

//   //BUTTON ACTIVE STYLING
//   dashBtn.classList.remove('btn-active')
//   shiftsBtn.classList.remove('btn-active')
//   overtimeBtn.classList.add('btn-active')
//   offBusBtn.classList.remove('btn-active')
// }

// function renderShift(){
//   //MAIN CONTENT ACTIVATOR
//   dashContain.style.display = "none"
//   shiftsContain.style.display = "block"
//   overtimeContain.style.display = "none"
//   offBusContain.style.display = "none"

//   //BUTTON ACTIVE STYLING
//   dashBtn.classList.remove('btn-active')
//   shiftsBtn.classList.add('btn-active')
//   overtimeBtn.classList.remove('btn-active')
//   offBusBtn.classList.remove('btn-active')
// }

// function renderOffBus(){
//     //MAIN CONTENT ACTIVATOR
//     dashContain.style.display = "none"
//     shiftsContain.style.display = "none"
//     overtimeContain.style.display = "none"
//     offBusContain.style.display = "block"

//     //BUTTON ACTIVE STYLING
//     dashBtn.classList.remove('btn-active')
//     shiftsBtn.classList.remove('btn-active')
//     overtimeBtn.classList.remove('btn-active')
//     offBusBtn.classList.add('btn-active')
// }
//=========RENDERING FUNCTIONS==========//

// MODAL CONTAINERS
const modalBg = document.getElementById("bg")
const overtimeModal = document.getElementById("overtime-modal-container")
const shiftModal = document.getElementById("shift-modal-container")
const offbusModal = document.getElementById("offBusiness-modal-container")
const otEditModal = document.getElementById("otEdit-modal-container")
const shiftEditModal = document.getElementById("shiftEdit-modal-container")
const offEditModal = document.getElementById("offBusEdit-modal-container")

// ADD BUTTONS
const addOvertimeBtn = document.getElementById("addOvertime-btn").addEventListener("click",function(){
    overtimeModal.style.display = "block"
    modalBg.style.display = "block"
})
const addShiftBtn = document.getElementById("addShifts-btn").addEventListener("click",function(){
    shiftModal.style.display = "block"
    modalBg.style.display = "block"
}) 
const addOffBusBtn = document.getElementById("addOffBusiness-btn").addEventListener("click",function(){
    offbusModal.style.display = "block"
    modalBg.style.display = "block"
})


// MODAL CANCEL BUTTONS
const otCancelBtn = document.getElementById("otCancel-btn").addEventListener("click",function(){
        
    document.getElementById("overtime-form").reset()

    overtimeModal.style.display = "none"
    modalBg.style.display = "none"
})
const shiftCancelBtn = document.getElementById("shiftCancel-btn").addEventListener("click", function(){
    
    document.getElementById("shift-form").reset()

    shiftModal.style.display = "none"
    modalBg.style.display = "none"
})
const offBusCancelBtn = document.getElementById("offBusCancel-btn").addEventListener("click",function(){
    document.getElementById("offBusiness-form").reset()

    offbusModal.style.display = "none"
    modalBg.style.display = "none"
})

//OVERTIME SEARCH FUNCTION
const overtimeTable = document.getElementById("overtime-table-body")
const overtimeSearch = document.getElementById("overtime-search")

overtimeSearch.addEventListener('input', () => {
  const searchText = overtimeSearch.value.toLowerCase();

  for (let i = 0; i < overtimeTable.rows.length; i++) {
    const row = overtimeTable.rows[i];
    const otName = row.cells[0].textContent.toLowerCase()
    const otCompany = row.cells[1].textContent.toLowerCase()
    const otDepartment = row.cells[2].textContent.toLowerCase()
    const otPosition = row.cells[3].textContent.toLowerCase()

    if (
      otName.includes(searchText) ||
      otCompany.includes(searchText) ||
      otDepartment.includes(searchText) ||
      otPosition.includes(searchText)
    ) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  }
});

//CHANGE SHIFT SEARCH FUNCTION
const shiftTable = document.getElementById("shift-table-body")
const shiftSearch = document.getElementById("shifts-search")

shiftSearch.addEventListener('input', () => {
  const searchText = shiftSearch.value.toLowerCase();

  for (let i = 0; i < shiftTable.rows.length; i++) {
    const row = shiftTable.rows[i];
    const shiftName = row.cells[0].textContent.toLowerCase()
    const shiftCompany = row.cells[1].textContent.toLowerCase()
    const shiftDepartment = row.cells[2].textContent.toLowerCase()
    const shiftApproved = row.cells[5].textContent.toLowerCase()

    if (
      shiftName.includes(searchText) ||
      shiftCompany.includes(searchText) ||
      shiftDepartment.includes(searchText) ||
      shiftApproved.includes(searchText)
    ) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  }
});

//OFFICIAL BUSINESS SHIFT SEARCH FUNCTION
const offBusTable = document.getElementById("offBusiness-table-body")
const offBusSearch = document.getElementById("offBusiness-search")

offBusSearch.addEventListener('input', () => {
  const searchText = offBusSearch.value.toLowerCase();

  for (let i = 0; i < offBusTable.rows.length; i++) {
    const row = offBusTable.rows[i];
    const offBusName = row.cells[0].textContent.toLowerCase()
    const offBusCompany = row.cells[1].textContent.toLowerCase()
    const offBusDepartment = row.cells[2].textContent.toLowerCase()
    const offBusStatus = row.cells[4].textContent.toLowerCase()
    const offBusApproved = row.cells[5].textContent.toLowerCase()

    if (
      offBusName.includes(searchText) ||
      offBusCompany.includes(searchText) ||
      offBusDepartment.includes(searchText) ||
      offBusStatus.includes(searchText) ||
      offBusApproved.includes(searchText)
    ) {
      row.style.display = ''
    } else {
      row.style.display = 'none'
    }
  }
})


//RENDERING CONTAINERS AND PREVENT FROM RETURNING TO DASHBOARD
const selectedModule = localStorage.getItem('selectedModule');

// Set the initial selected module or the default module if none is stored
const initialModule = selectedModule || 'dash';
renderModule(initialModule);

// Attach event listeners to the buttons
dashBtn.addEventListener('click', function () {
  renderModule('dash');
});
shiftsBtn.addEventListener('click', function () {
  renderModule('shifts');
});
overtimeBtn.addEventListener('click', function () {
  renderModule('overtime');
});
offBusBtn.addEventListener('click', function () {
  renderModule('offBusiness');
});

// Render the module based on the selected module
function renderModule(module) {
  // Hide all modules and deactivate all buttons
  dashContain.style.display = 'none';
  shiftsContain.style.display = 'none';
  overtimeContain.style.display = 'none';
  offBusContain.style.display = 'none';

  dashBtn.classList.remove('btn-active');
  shiftsBtn.classList.remove('btn-active');
  overtimeBtn.classList.remove('btn-active');
  offBusBtn.classList.remove('btn-active');

  // Show the selected module and activate its button
  if (module === 'dash') {
    dashContain.style.display = 'block';
    dashBtn.classList.add('btn-active');
  } else if (module === 'shifts') {
    shiftsContain.style.display = 'block';
    shiftsBtn.classList.add('btn-active');
  } else if (module === 'overtime') {
    overtimeContain.style.display = 'block';
    overtimeBtn.classList.add('btn-active');
  } else if (module === 'offBusiness') {
    offBusContain.style.display = 'block';
    offBusBtn.classList.add('btn-active');
  }

  // Store the selected module in browser storage
  localStorage.setItem('selectedModule', module);
}

// Function to handle logout
function handleLogout() {
  localStorage.removeItem('selectedModule'); // Remove the selected module from storage
  renderModule('dash'); // Set the dashboard as the default module
  // Perform any additional logout actions here
}

// Add event listener to the logout button
const logoutBtn = document.getElementById("logout-btn");
logoutBtn.addEventListener("click", handleLogout);

