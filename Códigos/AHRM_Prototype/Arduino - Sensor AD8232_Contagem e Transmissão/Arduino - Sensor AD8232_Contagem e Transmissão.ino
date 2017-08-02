int output = 2; 
volatile int batimentos = 0;
int bpm = 0;

void setup() {
  
  pinMode(10, INPUT); // Setup for leads off detection LO +
  pinMode(11, INPUT); // Setup for leads off detection LO -
  pinMode(output, INPUT);
  
  attachInterrupt(digitalPinToInterrupt(output), interruption, RISING);
  
  Serial.begin(9600);

}

void loop() {
  
  delay(2000);
  
  if((digitalRead(10) == 1)||(digitalRead(11) == 1)){
    
    Serial.println('!');
    
  }
  else{
    
    // send the value of analog input 0:
    // Serial.println(analogRead(A0));
    
    bpm = batimentos * 30;
    
    Serial.println(bpm);
    
    batimentos = 0;

  }

 delay(1); 
  
}


void interruption() {

  batimentos = batimentos + 1;
  
  // Serial.println(batimentos);
  
}
