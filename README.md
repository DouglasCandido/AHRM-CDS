# AHRM-CDS

AHRM CDS (Alternative Heart Rate Monitor Clinical Decision Support) is a telemedicine system designed to assist in the diagnosis of possible heart disease that a person has.

Its architecture is composed of two parts that interconnect as a whole: the AHRM Prototype (A low-cost embedded heart rate monitor) and AHRM Web (A website that connects the patient to the doctor).

AHRM Web: It is a website created to connect the patient to his doctor, so that the diagnosis of the disease can be made online. This website was developed using JavaScript, PHP and MySQL technologies.

AHRM Prototype: It is a low-cost heart rate monitor, consisting of hardware and desktop software. This embedded system was developed using Arduino and Processing technologies.

Modus operandi: The patient undergoes an Electrocardiogram (ECG) test performed by AHRM Prototype. The collected data is transmitted to the application, the software is in charge of plotting the chart and working out a heart wave pattern. The patient should report his / her clinical symptoms / parameters through the website.
All data collected from the patient is automatically saved to a database. This data is the result of the exam and will be converted to PDF format.
The patient should send the PDF to the doctor through the website. The doctor should analyze the result of the examination, draw up an award and send it to the patient through the website.

Portuguese:

AHRM CDS (Alternative Heart Rate Monitor Clinical Decision Support) é um sistema de telemedicina concebido para auxiliar no diagnóstico de possíveis doenças cardíacas que uma pessoa tem. 
Sua arquitetura é composta de duas partes que se interligam como um todo: o AHRM Prototype (Um monitor de frequência cardíaca embarcado de baixo custo) e o AHRM Web (Um website que conecta o paciente ao médico).

AHRM Web: É um website criado para interligar o paciente à seu médico, de modo que o diagnóstico da doença possa ser feito online. Esse website foi desenvolvido utilizando as tecnologias JavaScript, PHP e MySQL.

AHRM Prototype: É um monitor de frequência cardíaca de baixo custo, é composto de um hardware e um software para desktop. Esse sistema embarcado foi desenvolvido utilizando as tecnologias Arduino e Processing.  

Funcionamento: O paciente passa por um exame de Eletrocardiograma (ECG) realizado pelo AHRM Prototype. Os dados coletados são transmitidos para o aplicativo, o software se encarrega de plotar o gráfico e elaborar um padrão de onda cardíaca. O paciente deve informar os seus sintomas/parâmetros clínicos através do website. 
Todos os dados coletados do paciente são salvos automaticamente em um banco de dados. Esses dados são o resultado do exame e serão convertidos para o formato PDF. 
O paciente deve enviar o PDF para o médico através do website. O médico deve analisar o resultado do exame, elaborar um laudo e enviar para o paciente através do website.
