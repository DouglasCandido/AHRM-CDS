# AHRM CDS First Implementation

AHRM CDS (Alternative Heart Rate Monitor Clinical Decision Support) is a telemedicine system designed to assist in the diagnosis of possible heart disease that a person has.

Its architecture is composed of two parts that interconnect as a whole: the AHRM Prototype (A low-cost embedded heart rate monitor) and AHRM Web (A website that connects the patient to the doctor).

AHRM Web: It is a website created to connect the patient to his doctor, so that the diagnosis of the disease can be made online. This website was developed using JavaScript, PHP and MySQL technologies.

AHRM Prototype: It is a low-cost heart rate monitor, consisting of hardware and desktop software. This embedded system was developed using Arduino and Processing technologies.

Modus operandi: The patient undergoes an Electrocardiogram (ECG) test performed by AHRM Prototype. The collected data is transmitted to the application, the software is in charge of plotting the chart and working out a heart wave pattern. The patient should report his / her clinical symptoms / parameters through the website.
All data collected from the patient is automatically saved to a database. This data is the result of the exam and will be converted to PDF format.
The patient should send the PDF to the doctor through the website. The doctor should analyze the result of the examination, draw up an award and send it to the patient through the website.

