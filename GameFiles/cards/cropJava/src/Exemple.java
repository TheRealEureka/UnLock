import javax.imageio.ImageIO;
import java.awt.image.BufferedImage;
import java.io.File;

/**
 * @author: Tristan BELMONT
 * @author: Kevin BULLY CIMBALURIA
 */

public class Exemple {
    public static void main(String[] args) {
        
        for (int i = 1; i < 9; i++){
            try {
                // read image from file
                BufferedImage image = ImageIO.read(new File("source/"+i+".png"));
                // crop image
                ImageCroper.crop(image, i);
                //ImageCroper.crop_one(image, i, 59, 145, 1520, 1843);
            } catch (Exception e) {
                e.printStackTrace();
            }
        }

    }
}
