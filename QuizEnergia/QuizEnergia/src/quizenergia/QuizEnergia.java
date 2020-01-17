/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package quizenergia;

// Java Program to create a WebView and load  
// a website, set the fontscale, also set  
// the zoom and display it on the stage 
import java.net.URL;
import javafx.application.Application; 
import javafx.scene.Scene;
import javafx.stage.Stage;
import javafx.scene.web.*; 
  
public class QuizEnergia extends Application { 
  
    // launch the application 
    @Override
    public void start(Stage stage) 
    { 
  
        try { 
  
            // set title for the stage 
            stage.setTitle("LEGGI LA DOMANDA!!!!!"); 
  
            // create a webview object 
            WebView w = new WebView(); 
  
            // get the web engine 
            WebEngine e = w.getEngine(); 
  
            // load a website
            URL url = this.getClass().getResource("quiz/index.html");
            e.load(url.toString()); 
  
            // set font scale for the webview 
            w.setFontScale(1.5f); 
  
            // set zoom 
            w.setZoom(0.8); 
  
            // create a scene 
            Scene scene = new Scene(w, w.getPrefWidth(), 
                                     w.getPrefHeight()); 
  
            // set the scene 
            stage.setScene(scene); 
  
            stage.show(); 
        } 
  
        catch (Exception e) { 
  
            System.out.println(e.getMessage()); 
        } 
    } 
  
    // Main Method 
    public static void main(String args[]) 
    { 
  
        // launch the application 
        launch(args); 
    } 
} 
