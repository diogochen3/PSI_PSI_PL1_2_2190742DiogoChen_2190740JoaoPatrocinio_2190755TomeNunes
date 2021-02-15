package amsi.dei.estg.ipleiria.healthschedule.model;

public class Horario {
    private int id, usado, id_medico;
    private String tempo;

    public Horario(int id, int usado, int id_medico, String tempo) {
        this.id = id;
        this.usado = usado;
        this.id_medico = id_medico;
        this.tempo = tempo;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String gettempo() {
        return tempo;
    }

    public void settempo(String tempo) {
        this.tempo = tempo;
    }

    public int getUsado() {
        return usado;
    }

    public void setUsado(int usado) {
        this.usado = usado;
    }

    public int getId_medico() {
        return id_medico;
    }

    public void setId_medico(int id_medico) {
        this.id_medico = id_medico;
    }
}
