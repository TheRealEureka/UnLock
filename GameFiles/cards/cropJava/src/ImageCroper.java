import javax.imageio.ImageIO;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;

/**
 * @author: Tristan BELMONT
 * @author: Kevin BULLY CIMBALURIA
 */

public class ImageCroper {

    /**
     * Crop an image
     *
     * @param image the image to crop
     * @param i     the number of the image
     * @throws IOException if the image cannot be saved
     */

    public static void crop(BufferedImage image, int id) throws IOException {

        BufferedImage subImage = image;

        for (int ite = 1; ite < 7; ite++) {

            switch (ite) {
                case 1:
                    subImage = image.getSubimage(0, 0, 519, 921);
                    break;
                case 4:
                    subImage = image.getSubimage(0, 921, 519, 921);
                    break;
                case 3:
                    subImage = image.getSubimage(519 + 481, 0, 519, 921);
                    break;
                case 6:
                    subImage = image.getSubimage(519 + 481, 921, 519, 921);
                    break;
                case 2:
                    subImage = image.getSubimage(519, 0, 481, 921);
                    break;
                case 5:
                    subImage = image.getSubimage(519, 921, 481, 921);
                    break;

            }
            File f = new File("generated/1/" + id + "_" + ite + ".png");
            ImageIO.write(subImage, "png", f);

        }

    }


    /**
     * Crop an image
     *
     * @param image the image to crop
     * @param id    the number of the image
     * @param x     the x coordinate of the upper left corner of the specified rectangular region
     * @param y     the y coordinate of the upper left corner of the specified rectangular region
     * @param w     the width of the specified rectangular region
     * @param h     the height of the specified rectangular region
     * @throws IOException if the image cannot be saved
     */
    public static void crop_one(BufferedImage image, int id, int x, int y, int w, int h) throws IOException {
        BufferedImage subImage = image.getSubimage(x, y, w, h);
        File f = new File("generated/" + id + ".png");
        ImageIO.write(subImage, "png", f);
    }

}
