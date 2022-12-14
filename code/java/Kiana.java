import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import java.io.*;
import java.net.*;
import java.nio.file.Files;
import java.nio.file.Paths;

class Kiana implements ActionListener {

/*/
Built in JDK 12.0.2
/*/

    JFrame main = new JFrame();
    ImageIcon logo = new ImageIcon("logo_1.png");

    JLabel logoFrame = new JLabel(logo);
    JLabel labelStatus = new JLabel("<html><br><br>Welcome to Kiana 1.0!<br><br><br><br><br><br>");
    JLabel labelWalletAddress = new JLabel();
    JLabel labelInfo = new JLabel("<html><i>Kiana</i> is a open-source independent electronic music platform <br><br>that provides both the best music found in sites under Creative Commons<br><br> License as a basic software for download and share the musics!");
    JLabel labelShowInput = new JLabel();
    JLabel labelGuide = new JLabel("<html>News<br><br>kiana-music.blogspot.com<br>kianamusic.000webhostapp.com<br>t.me/kianamusicapp<br>kiana.rf.gd<br>kiana.atwebpages.com<br>kianas.neocities.org<br>@KianaMusics");
    JLabel labelDonate = new JLabel("Donate via PayPal: aerae4@gmail.com / Pix: aerae4@gmail.com");   

    String wallet = "";
    int fileCounter = 0;
    
    Kiana() {

        final int windowHeight = 600;        
        final int windowWidth = 800;
        final int buttonHeight = 30;
        final int buttonWidth = 100;
        final int grayHexadecimalColor = 0xCCCCCC;

        JButton buttonSendSingle = new JButton("SendLink");
        JButton buttonExit = new JButton("Exit");
        JButton buttonDownload = new JButton("Download");
        JButton buttonSend = new JButton("Send");
        JButton buttonDownloadBin = new JButton("Downloads");
        JButton buttonWallet = new JButton("Wallet");
        JButton buttonGuide = new JButton("Guide");

        buttonDownload.setBackground(Color.black);
        buttonDownload.setBorderPainted(false);
        buttonDownload.setFocusPainted(false);

        buttonSendSingle.addActionListener(this);
        buttonExit.addActionListener(this);
        buttonDownload.addActionListener(this);
        buttonSend.addActionListener(this);
        buttonDownloadBin.addActionListener(this);
        buttonWallet.addActionListener(this);
        buttonGuide.addActionListener(this);

        buttonSendSingle.setPreferredSize(new Dimension(buttonWidth, buttonHeight));
        buttonExit.setPreferredSize(new Dimension(buttonWidth, buttonHeight));
        buttonDownload.setPreferredSize(new Dimension(buttonWidth, buttonHeight));
        buttonSend.setPreferredSize(new Dimension(buttonWidth, buttonHeight));
        buttonDownloadBin.setPreferredSize(new Dimension(buttonWidth, buttonHeight));
        buttonWallet.setPreferredSize(new Dimension(buttonWidth, buttonHeight));
        buttonGuide.setPreferredSize(new Dimension(buttonWidth, buttonHeight));
        
        buttonSendSingle.setBounds(200, 200, 200, 200);
        buttonDownloadBin.setBounds(200, 200, 200, 200);
        buttonExit.setBounds(200, 200, 200, 200);
        buttonWallet.setBounds(200, 200, 200, 200);
        buttonGuide.setBounds(200, 200, 200, 200);

        JPanel bottom = new JPanel(new FlowLayout(FlowLayout.CENTER));
        bottom.setBackground(new Color(0x666666));
        bottom.setBounds(0, 500, 800, 200);    

        bottom.add(buttonDownload);    
        bottom.add(buttonWallet); 
        bottom.add(buttonSend);        
        bottom.add(buttonSendSingle);                
        bottom.add(buttonDownloadBin);
        bottom.add(buttonGuide);
        bottom.add(buttonExit);         
        bottom.add(labelDonate);    

        JPanel left = new JPanel();
        left.setBackground(new Color(0x111111));
        left.setBounds(0, 0, windowHeight, windowWidth); 

        left.add(logoFrame); 
   
        left.add(labelStatus); 
        left.add(labelWalletAddress); 
        left.add(labelInfo); 
 
        JPanel right = new JPanel();
        right.setBackground(new Color(0xAAAAAA));
        right.setBounds(600, 0, 200, 600); 

        right.add(labelShowInput); 
        right.add(labelGuide); 
                 
        main.setVisible(true);
        main.setSize(windowWidth, windowHeight);
        main.setTitle("Kiana 1.0");
        main.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        main.setResizable(false);
        main.setLayout(null);
        main.add(bottom);
        main.add(left);
        main.add(right);
        
        main.setIconImage(logo.getImage());      
    }
    
    public void actionPerformed(ActionEvent event) {         

        String buttonName = (((JButton) event.getSource()).getText());
      
        if (buttonName.equals("Exit")) {              
             System.out.print("Exit");
             System.exit(0);
         } 

        if (buttonName.equals("Wallet")) {     
             wallet = (String)JOptionPane.showInputDialog(main, "Wallet:","User Wallet",JOptionPane.PLAIN_MESSAGE,logo, null,"");
             System.out.print(wallet); 
             labelShowInput.setText("<html>User Wallet: <br>" + wallet);  
        } 

      
        if (buttonName.equals("Download")) {
            /* Download the files of the sites and URLs present in servers_download.txt

            Example of URL input in list.txt

            http://localhost/files.php
            http://localhost/files/files.php

            */             

            // Create the folder "files" for save the files 
            String fileFolder = "files";

            File theDir = new File(fileFolder);
                     
            if (!theDir.exists()){
                theDir.mkdirs();
            }    

            try  
            {  
                // Read the list of URLS in "servers_download.txt"     

                File file = new File("servers_download.txt");    
                FileReader fr = new FileReader(file);  
                BufferedReader br = new BufferedReader(fr);  
                StringBuffer sb = new StringBuffer();   

                String line;  
                String urlInsert;
                String URLhash;

                String prevStatus = "<html>";         

                while((line=br.readLine())!=null)  
                {
                    try  
                    {                

                    // Create a hash for each URL and a folder for save the files                                      
                    URLhash = Integer.toString(line.hashCode());                      
        
                    File URLhashDir = new File(fileFolder + "/" + URLhash );
                     
                    if (!URLhashDir.exists()){
                        URLhashDir.mkdirs();
                    }    

                         System.out.println("Downloading");           

                         File fileFullPath;
                         String urlDir = "";
                         String urlContents = "";
                         String hashURL = "";
                         String filename;
                         URL url;                       
                        
                         int blankEntries = 0;
                         String line2 = "";

                         fileCounter = 0;

                         // Loop each URL with "id" Get variable
                         while (true){
 
                            fileCounter++;      
   
                            urlDir = line + "?id=" +  fileCounter;
                            
                            StringBuilder content = new StringBuilder();  

                            url = new URL(urlDir); // creating a url object  
                            URLConnection urlConnection = url.openConnection(); // creating a urlconnection object  
    
                            // wrapping the urlconnection in a bufferedreader  
                            BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(urlConnection.getInputStream()));   
                            // reading from the urlconnection using the bufferedreader  
    
                            while ((line2 = bufferedReader.readLine()) != null)  
                            {  
                                content.append(line2);  
                            }  
       
                            bufferedReader.close();  

                            hashURL = content.toString(); 

                            // Discard the first three characters (unwanted characters can be in txt file)
                            hashURL = hashURL.substring(3); 
                            
                            filename = hashURL.substring(hashURL.lastIndexOf("/") + 1);

                            if(hashURL.equals("")){break;}

                            if(blankEntries > 1){System.out.println("Reached");blankEntries = 0; break;}

                            fileFullPath = new File(fileFolder + "/" + URLhash + "/" + filename);
              
                            //If the file exists jump to the next
                            if (fileFullPath.exists()){System.out.println(filename + " Already exists");continue;}  

                            System.out.println(hashURL);
                
                            try (InputStream in = URI.create(hashURL).toURL().openStream()) {

                                Files.copy(in, Paths.get(fileFolder + "/" + URLhash + "/" + filename));                    

                                System.out.println(urlDir);                                
                
                            } catch (IOException f) {
		   	        f.printStackTrace();

                            }
                        }                              

                    } catch (IOException f) {
                        f.printStackTrace();
                    } 

                fr.close();
                      
                }
               
            } catch (IOException f) {
                f.printStackTrace();
            }

        labelShowInput.setText("<html>Status:<br>Download done!");
                
        } 

        if (buttonName.equals("Send")) {

        /* 

        Read a list of URLs and send to each URL the files from "send_files" folder via base64
        Each url need be separated by line feed.   

        */

            System.out.println("Send");   

            if (wallet.equals("")){JOptionPane.showMessageDialog(main, "Your wallet address is blank or empty.", "Empty Wallet",  JOptionPane.WARNING_MESSAGE);}else{ 

                try  
                {  
                    //Read the list of URLS 
            
                    File file = new File("servers_send.txt");    
                    FileReader fr = new FileReader(file);  
                    BufferedReader br = new BufferedReader(fr);  
                    StringBuffer sb = new StringBuffer();   

                    String line;  
                    String urlInsert;

                    File folder = new File("send_links");
                    File[] files = folder.listFiles();  

                    String prevStatus = "<html>";         

                    while((line=br.readLine())!=null)  
                    {         
                        for (int i = 0; i < files.length; i++) {

                            if (files[i].isFile()) {

                                try  
                                {  
                                    // Read the contents of each base64 file                            

                                    FileReader fr2 = new FileReader(files[i]);   
                                    BufferedReader br2 = new BufferedReader(fr2);  
                                    StringBuffer sb2 = new StringBuffer();  

                                    String line2 = "";
                                    line2 = br2.readLine();

                                    String urlInsert2 = "";
                                    String urlClose2 = "";
                                    String[] chunks2 = null;
                         
                                    while(line2!=null)    
                                    {              
                                        sb2.append(line2);
                                        sb2.append(System.lineSeparator());
                                        line2 = br2.readLine();            
                                    }

                                    String everything2 = null;
                                    everything2 = sb2.toString();

                                    // Split the string in a equal lenght

                                    chunks2 = everything2.split("(?<=\\G.{1000})");

                                    for (int c = 0; c < chunks2.length; c++) {

                                        // URLEncoder for treat combinations that can broken the request

                                        urlInsert2 = line + "?hash=" + files[i].getName() + "&base64=" + URLEncoder.encode(chunks2[c], "UTF-8") + "&wallet=" + wallet;

                                        try (InputStream in = URI.create(urlInsert2).toURL().openStream()) {
                                        } catch (IOException f) {
                                            f.printStackTrace();
                                        }

                                        System.out.println("Part " + c +  " of " + files[i].getName() + " sent to:" + line);
                                    }

                                    urlClose2 = line + "?hash=" + "close" + "&base64=" + "close" + "&wallet=" + wallet;

                                    try (InputStream in = URI.create(urlClose2).toURL().openStream()) {                 
                                    } catch (IOException f) {
                                        f.printStackTrace();
                                    }
        
                                    prevStatus = prevStatus + "<br>" + files[i].getName() + " to" + line;
                                    labelShowInput.setText(prevStatus);                                               

                                    fr2.close();   

                                } catch (IOException f) {
                                    f.printStackTrace();
                                } 
                                                   
                            }
                 
                        }

                    }

                fr.close();  

                } catch (IOException f) {
                    f.printStackTrace();
                }
            }
        
        labelShowInput.setText("<html>Status:<br>Sent done!");  
    
        } 

        if (buttonName.equals("Downloads")) {

             /*
             Download all files from a host if each file has a continuous filename (1.jpg, 2.jpg, 3.jpg...)
   
               
             ex: http://google.com/1.jpg
                 http://google.com/2.jpg

             Don't matter the file extension. Count starts at 1.
             */

             System.out.println("Continuous");             

             String s = (String)JOptionPane.showInputDialog(main, "Host:","Continuous File Download",JOptionPane.PLAIN_MESSAGE,logo, null,"");

             String URLhash = Integer.toString(s.hashCode());    

             System.out.print(s); 

             String folder = "files/" + URLhash;

             File theDir = new File(folder);
             if (!theDir.exists()){
                 theDir.mkdirs();
             }     

             File fileFullPath;

             String fileExtension = "";
             String urlDir = "";

             for (;;){

                 fileCounter++;             
 
                 fileExtension = s.substring(s.lastIndexOf(".") + 1);

                 fileFullPath = new File(folder + "/" + fileCounter + "." + fileExtension);

                 // If the file exists jump to the next
                 if (fileFullPath.exists()){continue;}   

                 urlDir = s.substring(0, s.lastIndexOf("/"));

                 urlDir = urlDir + "/" + fileCounter + "." + fileExtension;
  
                
                 try (InputStream in = URI.create(urlDir).toURL().openStream()) {
                     Files.copy(in, Paths.get(folder + "/" + fileCounter + "." + fileExtension)); 
                     System.out.println(urlDir);
                     labelShowInput.setText(labelShowInput.getText() + "<br>" + urlDir);
                
                     } catch (IOException f) {
		   	    f.printStackTrace();

                     }
                }          
         
         } 

         if (buttonName.equals("SendLink")) {

         /*

         Read all files from a directory and send to a unique server
         the files need be in text format or base64
         
        
         */

             if (wallet.equals("")){JOptionPane.showMessageDialog(main, "Your wallet is blank or empty.", "Empty Wallet",  JOptionPane.WARNING_MESSAGE);}
  
             System.out.println("Send");    

             String s = (String)JOptionPane.showInputDialog(main, "Server:","Send Files",JOptionPane.PLAIN_MESSAGE,logo, null,"");

             System.out.println(s); 

             String sLastCharacter = s.substring(s.length() - 1); 

             File folder = new File("send_links");

             File[] files = folder.listFiles();              

             for (int i = 0; i < files.length; i++) {

                 if (files[i].isFile()) {

        try  
        {  
        //File[] file = new File(files[i]);    

        FileReader fr = new FileReader(files[i]);   
        BufferedReader br = new BufferedReader(fr);  
        StringBuffer sb = new StringBuffer();  

        String line = br.readLine();;
        String urlInsert;
        String urlClose;
        String[] chunks;

        while(line!=null)    
        {              
        sb.append(line);
        sb.append(System.lineSeparator());
        line = br.readLine();            
        }

         String everything = sb.toString();

         // Split the string in a equal lenght
         chunks = everything.split("(?<=\\G.{1000})");

           //chunks = everything.split("/");

           for (int c = 0; c < chunks.length; c++) {

            /* URLEncoder is necessary because sometimes combinations broken the query request  */
            urlInsert = s + "?hash=" + files[i].getName() + "&base64=" + URLEncoder.encode(chunks[c], "UTF-8") + "&wallet=" + wallet;

            try (InputStream in = URI.create(urlInsert).toURL().openStream()) {
                
                } catch (IOException f) {
                f.printStackTrace();
                }
           }  
                    urlClose = s + "?hash=" + "close" + "&base64=" + "close" + "&wallet=" + wallet;

                    try (InputStream in = URI.create(urlClose).toURL().openStream()) {
                
                } catch (IOException f) {
                f.printStackTrace();
                }

        fr.close();    //closes the stream and release the resources  
        }  
        catch(IOException e)  
        {  
        e.printStackTrace();  
        } 


                 } else if (files[i].isDirectory()) {
                 
                     System.out.println("Directory " + files[i].getName());

                 }
             }

         labelShowInput.setText("<html>Status:<br> Links sent!"); 
    
         } 

    if (buttonName.equals("Guide")) {

    JOptionPane.showMessageDialog(null, 
                              "<html> Welcome to Kiana! Your open-source project of independent electronic music.<br><br> Download: You will download all contents from sites in 'servers_download.txt'<br><br> Wallet: You can attach to your send the cryptocurrency and address that you use for donations, per example, BTC:A7561..., ETH:A65E8F1<br><br> Send: You can send the link of your music or page to all sites in 'serves_send.txt'.<br> The links or text need be in .txt format inside the folder 'send_links' or in base64 format for pictures<br><br> SendLink: You can send your .txt contents inside the folder 'send_link' to only one site.<br><br>Downloads: If a site save the files with a filename increment format, per example, 1.mp3, 2.mp3, 3.mp4...<br> You can save automatically all the files typing, per example, http://site.com/1.mp3 (works with other files formats) ", 
                              "Quick Guide", 
                              JOptionPane.PLAIN_MESSAGE);
    
    }
      

    }



    public static void main(String args[]){

        //Use the GUI 
        SwingUtilities.invokeLater(new Runnable() {
            public void run() {
                new Kiana();
            }
        }
    );    
    }
}