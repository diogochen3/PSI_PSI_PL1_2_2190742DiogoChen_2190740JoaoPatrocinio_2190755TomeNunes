package amsi.dei.estg.ipleiria.healthschedule.model;

public class Receita {

private int id, codigo_acesso, codigo_dispensa;

private String data_emissao;


    public Receita(int id, int quantidade, String nome_medicamento) {
        this.id = id;
        this.quantidade = quantidade;
        Nome_medicamento = nome_medicamento;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getQuantidade() {
        return quantidade;
    }

    public void setQuantidade(int quantidade) {
        this.quantidade = quantidade;
    }

    public String getNome_medicamento() {
        return Nome_medicamento;
    }

    public void setNome_medicamento(String nome_medicamento) {
        Nome_medicamento = nome_medicamento;
    }
}
