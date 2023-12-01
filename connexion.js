function connexionCheck() {
  var studentAccountType = document.querySelector(".studentRadio");
  var teacherAccountType = document.querySelector(".teacherRadio");
  var adminAccountType = document.querySelector(".adminRadio");
  var errorMessage = document.querySelector(".errorMessageConnexion");

  if (
    studentAccountType.checked ||
    teacherAccountType.checked ||
    adminAccountType.checked
  ) {
    return true;
  } else {
    console.log("Error");
    return false;
  }
}
