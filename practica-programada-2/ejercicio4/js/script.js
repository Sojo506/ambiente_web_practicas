const students = [
    { name: "Alice", last_name: "Smith", grade: 85 },
    { name: "Bob", last_name: "Johnson", grade: 92 },
    { name: "Charlie", last_name: "Williams", grade: 78 },
    { name: "David", last_name: "Brown", grade: 90 },
    { name: "Eve", last_name: "Davis", grade: 88 }
];

document.addEventListener("DOMContentLoaded", function () {
    const tableBody = document.querySelector("#students-table-body");
    const averageGradeElement = document.getElementById("average-grade");


    students.forEach(student => {
        const row = document.createElement("tr");

        const nameCell = document.createElement("td");
        nameCell.textContent = student.name;
        row.appendChild(nameCell);

        const lastNameCell = document.createElement("td");
        lastNameCell.textContent = student.last_name;
        row.appendChild(lastNameCell);

        const gradeCell = document.createElement("td");
        gradeCell.textContent = student.grade;
        row.appendChild(gradeCell);

        tableBody.appendChild(row);
    });

    const totalGrade = students.reduce((sum, student) => sum + student.grade, 0);
    const averageGrade = (totalGrade / students.length).toFixed(2);
    averageGradeElement.textContent = averageGrade;
});
