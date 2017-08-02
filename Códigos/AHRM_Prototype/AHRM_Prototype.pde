/* 

 Alternative Heart Rate Monitor
 
 Código implementado para o desenvolvimento do Projeto Integrador e TCC do Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Norte - Campus Caicó
 
 */

// Bibliotecas do Java
import javax.swing.JFrame;
import java.awt.Frame;

// Bibliotecas utilizadas para comunicação entre o Processing e o Arduino
import processing.serial.*;
import cc.arduino.*;

// Biblioteca utilizada para adicionar componentes gráficos
import controlP5.*;

// Variáveis utilizadas para guardar os valores lidos pela comunicação serial de cada Arduino
Serial myArduino1;    
Serial myArduino2;

// Variáveis utilizadas para gerar o gráfico
int xPos = 1;
float height_old = 0;
float height_new = 0;
float inByte = 0;

// Variável utilizada para guardar a variação de batimentos por minuto
int bpm = 0;

// Variáveis utilizadas na adição de componentes gráficos
private ControlP5 cp5;

ControlFrame cf1;

int bgColor;
String txtNome;
String txtCodigo;

Animation animation1;

float x_pos;
float y_pos;
float drag = 30.0;

void setup () {
  
  size(1000, 400); // Configura o tamanho da tela
  
  frameRate(5); // Configura a taxa de fps 

  background(0xff); // Configura a cor do plano de fundo
  
  // Configuração textual
  PFont font = createFont("arial", 20); 
  textSize(15);
  textAlign(LEFT);
  fill(#030303);

  println(Serial.list()); // Lista todas as portas seriais disponíveis

  // Seleciona a porta serial que está sendo usada, só irá gerar um novo serialEvent() quando encontrar um caractere delimitador de linha na leitura do buffer
 
  myArduino1 = new Serial(this, Serial.list()[0], 9600);
  myArduino1.bufferUntil('\n');
 
  myArduino2 = new Serial(this, Serial.list()[1], 9600);
  myArduino2.bufferUntil('\n');
  
  animation1 = new Animation("heart", 4); // Configura a animação do coração
  
  cp5 = new ControlP5(this);
  
  // Configura uma nova tela e adiciona um campo de texto para o usuário preencher
  cf1 = addControlFrame("Cadastro de Paciente", 400, 200, 50, 50, color(0));
 
  cf1.control().addTextfield("Nome").setPosition(20, 10).setSize(200, 30).setFont(font).setFocus(true).setColor(color(255, 0, 0)).addListener(new ControlListener() {
    public void controlEvent(ControlEvent ev) {
      txtNome = cf1.control().get(Textfield.class, "Nome").getText(); 
    }
  });
  
  cf1.control().addTextfield("Codigo").setPosition(20, 70).setSize(200, 30).setFont(font).setFocus(true).setColor(color(255, 0, 0)).addListener(new ControlListener() {
    public void controlEvent(ControlEvent ev) {
      txtCodigo = cf1.control().get(Textfield.class, "Codigo").getText(); 
      // txtCodigo = Integer.parseInt(txtCodigo);
    }
  });
   
}

void draw () {
  
  if(txtNome != null && txtCodigo != null) { // Começa a rodar só quando o usuário preencher os campos de texto
  
  fill(0); // Preenche o retângulo com a cor preta 
  noStroke(); // O retângulo estará sem bordas
  rect(0, 0, width, 100); // Desenha o retângulo, ele servirá de plano de fundo para a informação
  
  fill(255);  // Preenche as letras do texto com a cor branca
  
  // Exibição textual na tela
  text("AHRM Prototype - Monitor Cardíaco", width - 300, 20);
  text("Paciente: " + txtNome, 10, 20);  
  text("Codigo: " + txtCodigo, 10, 40);
  text(bpm + " BPM", 10, 60);
  
  animation1.display(950, 50); // Exibe a imagem nas coordenadas x e y especificadas como parâmetros do método
  
  saveFrame("imagens_dos_exames_dos_pacientes/" + txtNome + "/Onda de " + txtNome + "-####.png"); // Tira prints da tela e salva automaticamente na pasta
  
  }
  
}

void serialEvent(Serial myPort) {
  
  String inString = myArduino1.readStringUntil('\n'); // Lê a string ASCII enviada para o monitor serial até o caractere delimitador de linha
  
  if(myPort == myArduino1) {

    if (inString != null) {
    
      inString = trim(inString); // Elimina os espaços em branco

      // Se houver algum erro no monitoramento cardíaco irá desenhar uma linha plana azul
      if (inString.equals("!")) { 
      
        stroke(0, 0, 0xff); 
      
        inByte = 512;  // A linha plana azul será desenhada na posição relativa a metade do tamanho vertical da janela
      
      }
    
      // Se não houver erro no monitoramento cardíaco irá desenhar uma linha vermelha
      else {
      
        stroke(0xff, 0, 0); 
      
        inByte = float(inString); // Converte a string do monitor serial para um valor flutuante, desse modo será possível desenhar a linha vermelha na posição de acordo com o valor de inByte
      
      }

      // Desenha em um novo ponto a linha vermelha, mapeando uma faixa de valores possíveis para inByte
      inByte = map(inByte, 0, 1023, 0, height);
    
      height_new = height - inByte; 
      
      line(xPos - 1, height_old, xPos, height_new);

      height_old = height_new;
    
      // Quando chegar no final da tela irá retornar ao início da tela, zerar o contador e repinta-la de branco
      if (xPos >= width) {
      
        xPos = 0;
      
        background(0xff);

      } else { // Se ainda não chegou no final da tela irá incrementar a posição horizontal e o contador
    
        xPos++;
      
       } 
    
    }
  
  } else if(myPort == myArduino2) {
  
    String inString2 = myArduino2.readStringUntil('\n');
    inString2 = trim(inString2);
    bpm = Integer.parseInt(inString2); 
  
  }
  
}

public class ControlFrame extends PApplet {

  int w , h;
  int bg;
  
  public void setup() {
    
    size(w, h);
    
    cp5 = new ControlP5(this);  
    
  }

  public void draw() {
    
      background(bg);
      
  }
  
  private ControlFrame() {
  }

  public ControlFrame(Object theParent, int theWidth, int theHeight , int theColor) {
    
    parent = theParent;
    w = theWidth;
    h = theHeight;
    bg = theColor;
    
  }


  public ControlP5 control() {
    
    return this.cp5;
    
  }
  
  ControlP5 cp5;

  Object parent;
  
}

ControlFrame addControlFrame(String theName, int theWidth, int theHeight) {
  
  return addControlFrame(theName , theWidth , theHeight , 100 , 100 , color( 0 ) );
  
}

ControlFrame addControlFrame(String theName, int theWidth, int theHeight , int theX , int theY , int theColor ) {
  
  JFrame f = new JFrame(theName);
  ControlFrame p = new ControlFrame(this, theWidth, theHeight, theColor);
  
  f.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
  f.add(p);
  p.init();
  f.setTitle(theName);
  f.setSize(p.w, p.h);
  f.setLocation(theX, theY);
  f.setResizable(false);
  f.setVisible(true);
  
  try {
    
    Thread.sleep( 20 );
    
  } catch(Exception e) {
  }
  
  return p;
  
}

class Animation {
  
  PImage[] images;
  int imageCount;
  int frame;
  
  Animation(String imagePrefix, int count) {
    
    imageCount = count;
    images = new PImage[imageCount];

    for (int i = 0; i < imageCount; i++) {
      
      // nf() formata "i" em um número de 4 dígitos e concatena em uma string que representará o nome do arquivo
      String filename = imagePrefix + nf(i, 4) + ".gif";
      images[i] = loadImage(filename);
      
    }
    
  }

  void display(float xpos, float ypos) {
    
    frame = (frame+1) % imageCount;
    image(images[frame], xpos, ypos);
    
  }
  
}



