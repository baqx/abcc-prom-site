function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  sidebar.classList.toggle("active");

  const isActive = sidebar.classList.contains("active");
  document.querySelector(".dashboard-content").style.marginLeft = isActive
    ? "250px"
    : "20px";
}
