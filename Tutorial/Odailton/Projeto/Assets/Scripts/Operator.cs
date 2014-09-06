using UnityEngine;
using System.Collections;

public class Operator : MonoBehaviour {

	public Texture2D selecionadorHigh;
	public static Rect selection = new Rect(0, 0, 0, 0);
	private Vector3 click_inicial = -Vector3.one;

	// Use this for initialization
	void CheckCamera() 
	{
		if (Input.GetMouseButtonDown (0))
						click_inicial = Input.mousePosition;

		else if (Input.GetMouseButtonUp(0))
			click_inicial = -Vector3.one;

		if (Input.GetMouseButton (0))
		{
			selection = new Rect (click_inicial.x, InvertMouseY (click_inicial.y), Input.mousePosition.x - click_inicial.x, InvertMouseY (Input.mousePosition.y) - InvertMouseY (click_inicial.y));

			if (selection.width < 0)
			{
				selection.x += selection.width;
				selection.width = -selection.width;
			}
			if (selection.height < 0)
			{
				selection.y += selection.height;
				selection.height = -selection.height;
			}

		}

	}

	private void OnGui()
	{
		if (click_inicial != -Vector3.one)
		{
			GUI.color = new Color(1, 1, 1, 0.5f);
			GUI.DrawTexture(selection, selecionadorHigh);
		}
	}


	public static float InvertMouseY(float y)
	{
		return Screen.height - y;
	}
	
	// Update is called once per frame
	void Update () {
		CheckCamera ();
	
	}


}
