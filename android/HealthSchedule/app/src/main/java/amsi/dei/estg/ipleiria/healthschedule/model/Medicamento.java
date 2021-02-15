package amsi.dei.estg.ipleiria.healthschedule.model;

public class Medicamento {
    private int id;
    private String nome_medicamento, dosagem,embalagem, forma_farmaceuta;

    public Medicamento(int id, String nome_medicamento, String dosagem, String embalagem, String forma_farmaceuta) {
        this.id = id;
        this.nome_medicamento = nome_medicamento;
        this.dosagem = dosagem;
        this.embalagem = embalagem;
        this.forma_farmaceuta = forma_farmaceuta;
    }

    public String getForma_farmaceuta() {
        return forma_farmaceuta;
    }

    public void setForma_farmaceuta(String forma_farmaceuta) {
        this.forma_farmaceuta = forma_farmaceuta;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getNome_medicamento() {
        return nome_medicamento;
    }

    public void setNome_medicamento(String nome_medicamento) {
        this.nome_medicamento = nome_medicamento;
    }

    public String getDosagem() {
        return dosagem;
    }

    public void setDosagem(String dosagem) {
        this.dosagem = dosagem;
    }

    public String getEmbalagem() {
        return embalagem;
    }

    public void setEmbalagem(String embalagem) {
        this.embalagem = embalagem;
    }
}
