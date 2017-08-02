int output = 2;
volatile int batimentos = 0;
int bpm = 0;

void interruption() {

  batimentos = batimentos + 1;
  
}

void setup() {

  pinMode(output, INPUT);
  
  attachInterrupt(digitalPinToInterrupt(output), interruption, RISING);
  
  Serial.begin(9600);

}

void loop() {
  
    delay(2000);
    
    bpm = batimentos * 30;
    
    Serial.println(bpm);
    
    batimentos = 0;

    delay(1); 
  
}



